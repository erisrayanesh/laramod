<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


trait ProvidesTranslations
{

    protected function publishTranslations()
    {
        $sourcePath = $this->modulePath($this->getTranslationsPath());
        $translations = resource_path('lang' . DIRECTORY_SEPARATOR .
            'modules' . DIRECTORY_SEPARATOR . $this->getTranslationsNamespace()
        );
        $this->publishes([$sourcePath => $translations], [
            'translations',
            $this->getTranslationsNamespace(), $this->getModuleName() . '-module-translations'
        ]);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    protected function registerTranslations()
    {
        $langPath = resource_path('lang' . DIRECTORY_SEPARATOR . 'vendor' .
            DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->getTranslationsNamespace()
        );
        $this->loadTranslationsFrom(
            is_dir($langPath)? $langPath : $this->modulePath($this->getTranslationsPath())
        , $this->getTranslationsNamespace());
    }

    protected function getTranslationsNamespace(): string
    {
        return $this->getModuleName();
    }

    protected function getTranslationsPath(): string
    {
        return 'resources' . DIRECTORY_SEPARATOR . 'lang';
    }
}
