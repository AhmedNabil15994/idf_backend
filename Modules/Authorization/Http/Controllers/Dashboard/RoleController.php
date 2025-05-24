<?php

namespace Modules\Authorization\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Modules\Authorization\Repositories\Dashboard\PermissionRepository;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class RoleController extends Controller
{
    use CrudDashboardController{
        CrudDashboardController::__construct as private CrudConstruct;
    }

    private $permission;

    public function __construct(PermissionRepository $permission)
    {
        $this->CrudConstruct();
        $this->permission = $permission;
    }

    public function create()
    {
        Artisan::call('permission:cache-reset');
        $permissions = $this->permission->getAll('category');
        return $this->view('create' , compact('permissions'));
    }

    public function edit($id)
    {
        Artisan::call('permission:cache-reset');
        $role = $this->repository->findById($id);
        $permissions = $this->permission->getAll('category');
        return $this->view('edit' , compact('permissions','role'));
    }

}
