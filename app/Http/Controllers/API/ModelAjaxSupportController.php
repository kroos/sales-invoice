<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

// for controller output
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Response;
// use Illuminate\View\View;

// models
use App\Models\{
	ActivityLog, ProductCategory, Product, UserGroup, Sales, Customers, Banks, Taxes, User, SlipNumbers
};

// load db facade
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

// load validation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use {{ namespacedRequests }}

// load batch and queue
// use Illuminate\Bus\Batch;
// use Illuminate\Support\Facades\Bus;

// load email & notification
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;// more email

// load pdf
// use Barryvdh\DomPDF\Facade\Pdf;

// load helper
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

// load Carbon library
use \Carbon\Carbon;
use \Carbon\CarbonPeriod;
use \Carbon\CarbonInterval;

use Session;
use Throwable;
use Exception;
use Log;

class ModelAjaxSupportController extends Controller
{
	// this 1 need chunks sooner or later
	public function getActivityLogs(Request $request): JsonResponse
	{
		$values = ActivityLog::with('belongstouser')
		->when($request->search, function(Builder $query) use ($request){
			$query->where('model_type','LIKE','%'.$request->search.'%')
			->orWhere('ip_address','LIKE','%'.$request->search.'%');
		})
		->when($request->id, function($query) use ($request){
			$query->where('id', $request->id);
		})
		->orderBy('created_at', 'DESC')
		->get();
		return response()->json($values);
	}

	public function getProducts(Request $request): JsonResponse
	{
		$values = ProductCategory::query()
		->with(['product' => function ($q) use ($request) {
			$q->with('productimage');

			if ($request->id) {
				$q->where('id', $request->id);
			}

			if ($request->idIn) {
				$q->whereNotIn('id', $request->idIn);
			}

			if ($request->search) {
				$q->where('product', 'LIKE', '%' . $request->search . '%');
			}
		}])
		->when($request->search, function ($query) use ($request) {
			$query->where('product_category', 'LIKE', '%' . $request->search . '%')
			->orWhereHas('product', function ($q) use ($request) {
				$q->where('product', 'LIKE', '%' . $request->search . '%');
			});
		})
		->when($request->id, function ($query) use ($request) {
			$query->whereHas('product', function ($q) use ($request) {
				$q->where('id', $request->id);
			});
		})
		->get();
		return response()->json($values);
	}

	public function getProductsdT(Request $request)
	{
		$values = Product::with(['category', 'productimage'])
		->when($request->id, function ($query) use ($request) {
			$query->where('id', $request->id);
		})
		->when($request->search, function ($query) use ($request) {
			$query->where('product', 'LIKE', '%' . $request->search . '%');
		})
		->get();
		return response()->json($values);
	}

	public function getUser(Request $request)
	{
		$values = UserGroup::with(['users' => function ($q) use ($request) {
			$q->when($request->id, function ($q1) use ($request) {
				$q1->where('id', $request->id);
			});
			$q->when($request->search, function ($q1) use ($request) {
				$q1->where('name', 'LIKE', '%'.$request->search.'%');
			});
		}])
		->get();
		return response()->json($values);
	}

	public function geSales(Request $request)
	{
		$values = Sales::query()
		->with([
			'slippostageimage',
			'customer',
			'slipnumber',
			'salestaxes',
			'salespayment',
			'invuser',
			'invitems' => fn ($q) =>
			$request->idii ? $q->where('id', $request->idii) : null,
		])
		->when($request->id, fn ($q) =>
					 $q->where('id', $request->id)
				 )
		->when($request->user, fn ($q) =>
					 $q->where('id_user', $request->user)
				 )
		->when($request->idii, fn ($q) =>
					 $q->whereHas('invitems', fn ($q2) => $q2->where('id', $request->idii))
				 )
		->get();

		return response()->json($values);
	}

	public function getCustomers(Request $request)
	{
		$values = Customers::when($request->search, function($q) use ($request) {
			$q->where('client', 'LIKE', '%'.$request->search.'%');
		})
		->when($request->id, function($q) use ($request) {
			$q->where('id', $request->id);
		})
		->get();
		return response()->json($values);
	}

	public function getBanks(Request $request)
	{
		$values = Banks::where('active', 1)
		->when($request->search, function($q) use ($request) {
			$q->where('bank', 'LIKE', '%'.$request->search.'%');
		})
		->when($request->id, function($q) use ($request) {
			$q->where('id', $request->id);
		})
		->when($request->idIn, function($q) use ($request) {
			$q->whereNotIn('id', $request->idIn);
		})
		->get();

		return response()->json($values);
	}

	public function getBanksT(Request $request)
	{
		$values = Banks::when($request->search, function($q) use ($request) {
			$q->where('bank', 'LIKE', '%'.$request->search.'%');
		})
		->when($request->id, function($q) use ($request) {
			$q->where('id', $request->id);
		})
		->when($request->idIn, function($q) use ($request) {
			$q->whereNotIn('id', $request->idIn);
		})
		->get();

		return response()->json($values);
	}

	public function getTaxes(Request $request)
	{
		$values = Taxes::when($request->search, function($q) use ($request) {
			$q->where('tax', 'LIKE', '%'.$request->search.'%');
		})
		->when($request->id, function($q) use ($request) {
			$q->where('id', $request->id);
		})
		->when($request->idIn, function($q) use ($request) {
			$q->whereNotIn('id', $request->idIn);
		})
		->get();

		return response()->json($values);
	}

	public function remoteusers(Request $request, User $user)
	{
		$valid = true;

		$users1 = User::all();
		foreach($users1 as $wer) {
			$users[$wer['username']] = $wer['email'];
		}

		if (request('username') && array_key_exists(request('username'), $users)) {
			$valid = false;
		} else if (request('email')) {
			$email = request('email');

			foreach ($users as $k => $v) {
				if ($email == $v) {
					$valid = false;
					break;
				}
			}
		}
		return response()->json([
			'valid' => $valid
		]);
	}

	public function customersearch(Request $request)
	{
		$valid = TRUE;
		$cust = Customers::where('client', $request->client)->count();
		$cust_email = Customers::where('client_email', $request->client_email)->count();
		$cust_phone = Customers::where('client_phone', $request->client_phone)->count();
		// dd($cust);

		if ($cust == 1)
		{
			$valid = FALSE;
		}
		else
		{
			if ($cust_phone == 1)
			{
				$valid = FALSE;
			}
			else
			{
				if ($cust_email == 1)
				{
					$valid = FALSE;
				} else {
					$valid = TRUE;
				}
			}
		}

		return response()->json(['valid' => $valid]);
	}

	public function slipnumbersearch(Request $request)
	{
		$valid = TRUE;
				// dd($cust);
		foreach ($request->serial as $key => $val) {
			$serialtrack = SlipNumbers::where('tracking_number', $val['tracking_number'])->count();
			if ($serialtrack == 1) {
				$valid = FALSE;
			} else {
				$valid = TRUE;
			}
			return response()->json(['valid' => $valid]);
		}
	}

	public function getStaffSales(Request $request)
	{
		$sales = Sales::with([
			'invuser:id,name,color',
			'invitems' => function ($query) {
				$query->where('id_product', '!=', 37)
				->with('product:id,product');
			}
		])
		->get(['id', 'id_user', 'date_sale'])
		->groupBy(fn ($sale) => $sale->date_sale->format('M Y'))
		->map(function ($monthlySales) {

			return $monthlySales
			->groupBy('id_user')
			->map(function ($userSales) {

				$items = $userSales
				->pluck('invitems')
				->flatten();

				return [
					'user' => $userSales->first()->invuser,

					// 1️⃣ commission × quantity (PER USER)
					'total_commission' => $items->sum(fn ($i) =>
																						(float) $i->commission * (int) $i->quantity
																					),

										// 2️⃣ retail × quantity (PER USER)
					'total_retail' => $items->sum(fn ($i) =>
																				(float) $i->retail * (int) $i->quantity
																			),

										// 3️⃣ quantity PER PRODUCT (PER USER)
					'product_quantities' => $items
					->groupBy(fn ($i) => optional($i->product)->product ?? 'Unknown')
					->map(fn ($rows) => $rows->sum('quantity')),
				];
			})
						->values(); // optional: removes user_id keys		});
    });
		return response()->json($sales);
	}


}
