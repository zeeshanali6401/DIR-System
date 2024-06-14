<div>
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <x-filament::input.wrapper>
            <x-filament::input type="date" wire:model="startDate" />
        </x-filament::input.wrapper><br>
        <x-filament::input.wrapper>
            <x-filament::input type="date" wire:model="endDate" />
        </x-filament::input.wrapper><br>
        <div>
            <x-filament::button wire:click="export"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                Export
            </x-filament::button>
        </div>
        </form>
    </div>
</div>
