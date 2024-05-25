<?php

namespace App\Policies;

use App\Models\DIR;
use Illuminate\Auth\Access\HandlesAuthorization;

class DIRPolicy
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
        return $userOrSupervisorOrPco->can('view_any_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can view the model.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\DIR $dir
     * @return bool
     */
    public function view($userOrSupervisorOrPco, DIR $dir): bool
    {
        return $userOrSupervisorOrPco->can('view_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can create models.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function create($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('create_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can update the model.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\DIR $dir
     * @return bool
     */
    public function update($userOrSupervisorOrPco, DIR $dir): bool
    {
        return $userOrSupervisorOrPco->can('update_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can delete the model.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\DIR $dir
     * @return bool
     */
    public function delete($userOrSupervisorOrPco, DIR $dir): bool
    {
        return $userOrSupervisorOrPco->can('delete_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can bulk delete.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function deleteAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('delete_any_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can permanently delete.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\DIR $dir
     * @return bool
     */
    public function forceDelete($userOrSupervisorOrPco, DIR $dir): bool
    {
        return $userOrSupervisorOrPco->can('force_delete_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can permanently bulk delete.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function forceDeleteAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('force_delete_any_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can restore.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\DIR $dir
     * @return bool
     */
    public function restore($userOrSupervisorOrPco, DIR $dir): bool
    {
        return $userOrSupervisorOrPco->can('restore_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can bulk restore.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function restoreAny($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('restore_any_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can replicate.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @param  \App\Models\DIR $dir
     * @return bool
     */
    public function replicate($userOrSupervisorOrPco, DIR $dir): bool
    {
        return $userOrSupervisorOrPco->can('replicate_d::i::r');
    }

    /**
     * Determine whether the User or Supervisor can reorder.
     *
     * @param  \App\Models\User|\App\Models\Supervisor|\App\Models\PCO  $userOrSupervisorOrPco
     * @return bool
     */
    public function reorder($userOrSupervisorOrPco): bool
    {
        return $userOrSupervisorOrPco->can('reorder_d::i::r');
    }
}
