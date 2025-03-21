<?php

namespace GroceryStore\PreOrderManagement\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use GroceryStore\PreOrderManagement\Actions\PreOrderConfirmationAction;
use GroceryStore\PreOrderManagement\Events\PreOrderEmailEvent;
use GroceryStore\PreOrderManagement\Models\PreOrder;
use GroceryStore\PreOrderManagement\Requests\PreOrderRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PreOrderController extends Controller
{
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {

            $phone = $request->get('phone');
            $email = $request->get('email');
            $name = $request->get('name');
            $productId = $request->get('preduct_id');
            
            $preOrders = PreOrder::query()
                ->when($name, function (Builder $query) use ($name) {
                    return $query->where('name', 'LIKE', '%'.$name.'%');
                })
                ->when($productId, function (Builder $query) use ($productId) {
                    return $query->where('product_id', $productId);
                })
                ->when($email, function (Builder $query) use ($email) {
                    return $query->where('email', 'LIKE', '%'.$email.'%');
                })
                ->when($phone, function (Builder $query) use ($phone) {
                    return $query->where('phone', 'LIKE', '%'.$phone.'%');
                })
                ->latest()
                ->paginate(config('app.per_page'));


            return response()->json([
                'success' => true,
                'message' => 'Pre Order created successfully.',
                'data' => $preOrders
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => app()->isProduction() ? 'Internal Server Error' : $e->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        //
    }

    
    public function store(PreOrderRequest $request, )
    {
        try {

            $preOrder = PreOrder::create($request->all());

            event(new PreOrderEmailEvent($preOrder));

            return response()->json([
                'success' => true,
                'message' => 'Pre Order created successfully.',
                'data' => []
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => app()->isProduction() ? 'Internal Server Error' : $e->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    
    public function update($id)
    {
        //
    }

    /**
     * Summary of destroy
     * @param \GroceryStore\PreOrderManagement\Models\PreOrder $preorder
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {


            $preOrder = PreOrder::query()->findOrFail($id);
            $preOrder->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pre Order deleted successfully.',
                'data' => []
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => app()->isProduction() ? 'Internal Server Error' : $e->getMessage(),
                'data' => []
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
