<?php

namespace ErisRayanesh\Laramod\Providers\Concerns;

use Illuminate\Support\Facades\Gate;

trait ProvidesPolicies
{
    public function registerPolicies()
    {
        foreach ($this->policies() as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }

    /**
     * Get the policies defined on the provider.
     *
     * @return array<class-string, class-string>
     */
    public function policies(): array
    {
        return [];
    }
}
