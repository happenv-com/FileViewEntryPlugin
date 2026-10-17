<?php

use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Facades\FilamentIcon;
use gheith3\FileViewEntryPlugin\Infolists\Components\FileViewEntry;
use gheith3\FileViewEntryPlugin\View\FileViewEntryIconAlias;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Livewire\Component;
use Livewire\Livewire;

class FileViewEntryAliasHost extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->state([
                'modal_files' => ['present.pdf', 'present.png'],
                'inline_files' => ['present.pdf'],
                'orphan_files' => ['present.pdf'],
            ])
            ->components([
                FileViewEntry::make('modal_files')->copyable()->downloadable(),
                FileViewEntry::make('inline_files')->asModal(false)->withModalEye()->copyable()->downloadable(),
                FileViewEntry::make('orphan_files')->disk('a-disk-that-does-not-exist'),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $this->infolist($schema);
    }

    public function render(): string
    {
        return '<div>{{ $this->infolist }}</div>';
    }
}

beforeEach(function () {
    config()->set('filament.default_filesystem_disk', 'local');
    Storage::fake('local');
    Storage::disk('local')->put('present.pdf', 'x');
    Storage::disk('local')->put('present.png', 'x');
});

it('renders the stock Heroicons when the host registers no alias', function () {
    expect(Livewire::test(FileViewEntryAliasHost::class)->html())
        ->not->toContain('data-alias-marker')
        ->toContain('<svg');
});

it('lets an alias registered by the host replace every chrome icon of the entry', function (string $alias) {
    FilamentIcon::register([$alias => new HtmlString('<svg data-alias-marker="'.$alias.'"></svg>')]);

    expect(Livewire::test(FileViewEntryAliasHost::class)->html())
        ->toContain('data-alias-marker="'.$alias.'"');
})->with([
    'file type pdf' => FileViewEntryIconAlias::FILE_TYPES_PDF,
    'file type image' => FileViewEntryIconAlias::FILE_TYPES_IMAGE,
    'close' => FileViewEntryIconAlias::ACTIONS_CLOSE,
    'open' => FileViewEntryIconAlias::ACTIONS_OPEN,
    'copy link' => FileViewEntryIconAlias::ACTIONS_COPY_LINK,
    'download' => FileViewEntryIconAlias::ACTIONS_DOWNLOAD,
    'preview' => FileViewEntryIconAlias::ACTIONS_PREVIEW,
    'file not found' => FileViewEntryIconAlias::STATES_FILE_NOT_FOUND,
]);
