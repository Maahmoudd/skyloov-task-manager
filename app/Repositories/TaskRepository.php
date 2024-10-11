<?php

namespace App\Repositories;

use App\Models\Task;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TaskRepository.
 *
 * @package namespace App\Repositories;
 */
class TaskRepository extends BaseRepository implements ITaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }


    protected $fieldSearchable = [
        'status',
        'due_date',
        'title',
    ];


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
