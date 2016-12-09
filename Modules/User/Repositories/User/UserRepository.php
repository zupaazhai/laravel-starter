<?php

namespace Modules\User\Repositories\User;

use App\Repositories\Repository;

class UserRepository extends Repository implements UserInterface {
    
    public $model = 'Modules\User\Entities\User';
    
    public function __construct()
    {
        $this->user = $this->model();
    }
    
    public function all()
    {
        return $this->user->all();
    }
}