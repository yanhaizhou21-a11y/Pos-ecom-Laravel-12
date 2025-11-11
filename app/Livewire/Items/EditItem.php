<?php

namespace App\Livewire\Items;

use App\Models\Item as ModelsItem;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditItem extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?ModelsItem $record = null;
    public ?array $data = [];

    public function mount(?ModelsItem $record = null): void
    {
        $this->record = $record ?? new ModelsItem();
        $this->form()->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rate limiting')
                ->description('Prevent abuse by limiting the number of requests per period')
                ->schema([
                 // ...
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        try {
            $data = $this->form()->getState();
            $this->record->update($data);

            Notification::make()
                ->title('Item updated successfully')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to update item')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function render(): View
    {
        return view('livewire.items.edit-item');
    }
}
