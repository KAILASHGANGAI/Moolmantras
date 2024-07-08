<?php

namespace App\Repositories;
 class BaseRepository
{
   
    /**
     * Get all instances of the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getData($model, $condition=NULL,  $columns)
    {
        return $model
        ->when($columns, function($query) use ($columns){
            return $query->select($columns);
        }) 
        ->when($condition != null   , function($query) use ($condition){
            return $query->where($condition);
        })
        ->get($columns);
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($model , array $data)
    {
        return $model->create($data);
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($model , $id)
    {
        return $model->find($id);
    }

    public function getSingleData($model,$condition=null)
    {
        return $model->where($condition)->first();
    }


    /**
     * Update a record in the database.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($model , $id, array $data)
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
    public function delete($model , $id)
    {
        $record = $model->find($id);

        if (!$record) {
            return false;
        }

        return $record->delete();
    }

    public function getWithPagination($model ,$paginate=20,$condition=null,  $columns=null){
        return $model
                ->when($columns, function($query) use ($columns){
                    return $query->select($columns);
                }) 
                ->when($condition != null   , function($query) use ($condition){
                    return $query->where($condition);
                })
                ->paginate($paginate);
    }

    public function getallDatas($model ,$condition=null,  $columns=null){
        return $model
                ->when($columns, function($query) use ($columns){
                    return $query->select($columns);
                }) 
                ->when($condition != null   , function($query) use ($condition){
                    return $query->where($condition);
                })
                ->get();
    }
}
