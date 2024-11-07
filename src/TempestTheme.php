<?php

namespace Tempest;

use App\Facades\Hook;
use App\Classes\Theme;
use App\Forms\Components\TinyEditor;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use luizbills\CSS_Generator\Generator as CSSGenerator;
use matthieumastadenis\couleur\ColorFactory;
use matthieumastadenis\couleur\ColorSpace;
use Illuminate\Support\Facades\Blade;



class TempestTheme extends Theme
{
	public function boot()
	{
		// dd($this->url('test.'));
		//"http://127.0.0.1:8001/plugin/everest/test.?v=1.0.0" // plugins/Everest/src/EverestTheme.php:30
		Blade::anonymousComponentPath($this->getPluginPath('resources/views/frontend/website/components'), prefix: 'tempest');
	}

	/**
	 * 
	 *
	 * @return array
	 */
	public function getFormSchema(): array
    {
        return [
                SpatieMediaLibraryFileUpload::make('banner')
                ->collection('tempest-banner')
                ->label('Upload Banner Images')
                ->image()
                ->conversion('thumb-xl')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
                SpatieMediaLibraryFileUpload::make('countdown')
                ->collection('tempest-countdown')
                ->label('Upload Countdown Background')
                ->image()
                ->conversion('thumb-xl')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),
				ColorPicker::make('appearance_color')
				->regex('/^#?(([a-f0-9]{3}){1,2})$/i')
				->label(__('general.appearance_color')),
				ColorPicker::make('secondary_color')
				->regex('/^#?(([a-f0-9]{3}){1,2})$/i')
				->label(__('Secondary Color'))
                ->hint('Secondary color for the border and color for the gradient.'),
                Builder::make('layouts')
                ->collapsible()
                ->collapsed()
                ->cloneable()
                ->blocks([
                    Builder\Block::make('layouts')
                        ->schema([
                            TextInput::make('name_content')
                                ->label('Name')
                                ->required(),
                                TinyEditor::make('about')
                                ->label('About Site')
                                ->profile('advanced')
                                // ->enableSvg()
                                ->required()
                        ]),

                ])
            ->reorderableWithButtons()
            ->collapsible()
            ->reorderableWithDragAndDrop(True),
        ];
    }
	
	public function onActivate(): void
{	
    Hook::add('Frontend::Views::Head', function ($hookName, &$output) {
        $output .= '<script src="https://cdn.tailwindcss.com"></script>';
 
        $cssTempest = $this->url('Tempest.css');
        $output .= "<link rel='stylesheet' type='text/css' href='$cssTempest'>";

        $cssGenerator = new CSSGenerator();

        if ($appearanceColor = $this->getSetting('appearance_color')) {
            $oklch = ColorFactory::new($appearanceColor)->to(ColorSpace::OkLch);
            $cssGenerator = new CSSGenerator();
            
            $cssGenerator->root_variable('primary-color', value: "{$oklch->lightness}% {$oklch->chroma} {$oklch->hue}");
        }

        if ($borderColor = $this->getSetting('secondary_color')) {
            $oklchBorder = ColorFactory::new($borderColor)->to(ColorSpace::OkLch);
            $cssGenerator->root_variable('secondary-color', value: "{$oklchBorder->lightness}% {$oklchBorder->chroma} {$oklchBorder->hue}");
        }
        
        $output .= <<<HTML
            <style>
                {$cssGenerator->get_output()}
            </style>
        HTML;
    });
}


	public function getFormData(): array 
    {
        $banner = $this->getSetting('banner');
        
        if (is_string($banner) && !empty($banner)) {
            $banner = [$banner];
        } elseif (!is_array($banner)) {
            $banner = [];
        }

        $countdown = $this->getSetting('countdown');
        
        if (is_string($countdown) && !empty($countdown)) {
            $countdown = [$countdown];
        } elseif (!is_array($countdown)) {
            $countdown = [];
        }

        return [
            'banner' => $banner,
            'countdown' => $countdown,
            'layouts' => $this->getSetting('layouts'),
			'appearance_color' => $this->getSetting('appearance_color'),
			'secondary_color' => $this->getSetting('secondary_color'),
        ];
    }
}