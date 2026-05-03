<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Tenant;
use App\Policies\Concerns\EnforcesTenantAuthorization;
use PHPUnit\Framework\TestCase;
use stdClass;

class TenantAuthorizationTest extends TestCase
{
    public function test_policy_does_not_fallback_to_model_id_when_tenant_id_is_missing(): void
    {
        $policy = new class
        {
            use EnforcesTenantAuthorization;

            public function exposedBelongsToSameTenant(User $user, object $model): bool
            {
                return $this->belongsToSameTenant($user, $model);
            }
        };

        $user = new User(['tenant_id' => 10]);
        $model = new stdClass;
        $model->id = 10;

        $this->assertFalse($policy->exposedBelongsToSameTenant($user, $model));
    }

    public function test_policy_allows_the_authenticated_tenant_model_itself(): void
    {
        $policy = new class
        {
            use EnforcesTenantAuthorization;

            public function exposedBelongsToSameTenant(User $user, object $model): bool
            {
                return $this->belongsToSameTenant($user, $model);
            }
        };

        $user = new User(['tenant_id' => 10]);
        $tenant = new Tenant;
        $tenant->id = 10;

        $this->assertTrue($policy->exposedBelongsToSameTenant($user, $tenant));
    }
}
