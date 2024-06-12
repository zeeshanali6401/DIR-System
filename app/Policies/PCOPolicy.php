<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PCO;
use Illuminate\Auth\Access\HandlesAuthorization;

class PCOPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the User or Supervisor can view any models.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function viewAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('view_any_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can view the model.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\PCO $pco
     * @return bool
     */
    public function view($userOrSupervisorOrPco, PCO $pco): bool
    {
        return $userOrSupervisorOrPco->can('view_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can create models.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function create($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('create_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can update the model.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\PCO $pco
     * @return bool
     */
    public function update($userOrSupervisorOrPco, PCO $pco): bool
    {
        return $userOrSupervisorOrPco->can('update_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can delete the model.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\PCO $pco
     * @return bool
     */
    public function delete($userOrSupervisorOrPco, PCO $pco): bool
    {
        return $userOrSupervisorOrPco->can('delete_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can bulk delete.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function deleteAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('delete_any_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can permanently delete.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\PCO $pco
     * @return bool
     */
    public function forceDelete($userOrSupervisorOrPco, PCO $pco): bool
    {
        return $userOrSupervisorOrPco->can('force_delete_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can permanently bulk delete.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function forceDeleteAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('force_delete_any_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can restore.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\PCO $pco
     * @return bool
     */
    public function restore($userOrSupervisorOrPco, PCO $pco): bool
    {
        return $userOrSupervisorOrPco->can('restore_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can bulk restore.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function restoreAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('restore_any_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can replicate.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\PCO $pco
     * @return bool
     */
    public function replicate($userOrSupervisorOrPco, PCO $pco): bool
    {
        return $userOrSupervisorOrPco->can('replicate_p::c::o');
    }

    /**
     * Determine whether the User or Supervisor can reorder.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function reorder($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('reorder_p::c::o');
    }
}
