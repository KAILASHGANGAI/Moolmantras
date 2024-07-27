<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BaseRepository
{

    /**
     * Get all instances of the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getData($model, $condition = NULL,  $columns = null, $limit = null,)
    {
        return $model
            ->when($columns, function ($query) use ($columns) {
                return $query->select($columns);
            })
            ->when($condition != null, function ($query) use ($condition) {
                return $query->where($condition);
            })
            ->when($limit != null, function ($query) use ($limit) {
                return $query->take($limit);
            })
            ->get($columns);
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($model, array $data)
    {
        return $model->create($data);
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($model, $id)
    {
        return $model->find($id);
    }

    public function getSingleData($model, $condition = null, $select = null)
    {
        return $model
            ->when($select != null, function ($q) use ($select) {
                $q->select($select);
            })
            ->where($condition)->first();
    }


    /**
     * Update a record in the database.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($model, $id, array $data)
    {
        $record = $model->find($id);

        if (!$record) {
            return false;
        }

        return $record->update($data);
    }

    /**
     * Delete a record from the database.
     *
     * @param int $id
     * @return bool
     */
    public function delete($model, $id)
    {
        $record = $model->find($id);

        if (!$record) {
            return false;
        }

        return $record->delete();
    }

    public function getWithPagination($model, $paginate, $condition = null,  $columns = null, $sort = null)
    {

        return $model
            ->when($columns, function ($query) use ($columns) {
                return $query->select($columns);
            })
            ->when($condition != null, function ($query) use ($condition) {
                return $query->where($condition);
            })
            ->when($sort != null, function ($query) use ($sort) {
                return $query->orderBy($sort['column'], $sort['value']);
            })
            ->paginate($paginate);
    }

    public function getallDatas($model, $condition = null,  $columns = null)
    {
        return $model
            ->when($columns, function ($query) use ($columns) {
                return $query->select($columns);
            })
            ->when($condition != null, function ($query) use ($condition) {
                return $query->where($condition);
            })
            ->get();
    }

    public function register($request)
    {
        $user = User::where(
            ['email' => $request->email]
        )->first();

        if (@$user) {
            return $user;
        }
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function order($delivaryCharge = 120, $payment_method, $status, $userID = 0)
    {
        $carts = session()->get('cart');
        $subtotal = 0;
        foreach ($carts as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $subtotal = number_format($subtotal, 2);
        $order = [
            "user_id" => $userID ,
            "orderNumber" => null,
            "total_price" => $subtotal,
            "status" => $status,
            "payment_method" => $payment_method,
            "no_of_item" => count($carts),
            "subtotal" => $subtotal,
            "delivaryCharge" => $delivaryCharge,
            "nettotal" => $subtotal + $delivaryCharge,
            "order_date" => Carbon::now()
        ];

       return $this->create(Order::query(), $order);
    }

    public function createOrUpdate($model , $condition , $data){
        return $model->updateOrCreate(
            $condition, 
            $data
        );
    }
}
