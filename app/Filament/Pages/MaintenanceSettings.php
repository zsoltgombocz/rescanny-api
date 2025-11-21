<?php

namespace App\Filament\Pages;

use App\Domains\Localization\SupportedLocalesRepository;
use App\Models\MaintenanceMode;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * @property Schema $form
 */
class MaintenanceSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.pages.maintenance-settings';

    protected static string|null|\BackedEnum $navigationIcon = Heroicon::AdjustmentsVertical;

    protected static string|null|\UnitEnum $navigationGroup = 'Beállítások';

    protected static ?string $title = 'Karbantartási beállítások';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $entry = MaintenanceMode::firstOrCreate();
        $this->form->fill($entry->toArray());
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Mentés')
                ->action(fn () => $this->save()),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns()
            ->components([
                Toggle::make('enabled')
                    ->columnSpanFull()
                    ->label('Karbantartás azonnali bekapcsolása'),

                DateTimePicker::make('from')
                    ->label('Karbantartás kezdete'),

                DateTimePicker::make('to')
                    ->label('Karbantertás vége'),

                ...$this->localizedDisplayMessageInputs(),

            ])->statePath('data');
    }

    /**
     * @return Textarea[]
     *
     * @throws BindingResolutionException
     */
    private function localizedDisplayMessageInputs(): array
    {
        $localeRepository = app()->make(SupportedLocalesRepository::class);

        return $localeRepository->getAll()->flatMap(function (string $label, string $locale) {
            return [
                Textarea::make("display_text.$locale")
                    ->label("$label megjelenítendő üzenet")
                    ->rows(3),
            ];
        })->toArray();
    }

    public function save(): void
    {
        if ($maintenanceMode = MaintenanceMode::first()) {
            $maintenanceMode->update($this->form->getState());

            Notification::make()
                ->title('Karbantartási beállítások mentve!')
                ->success()
                ->send();
        }
    }
}
