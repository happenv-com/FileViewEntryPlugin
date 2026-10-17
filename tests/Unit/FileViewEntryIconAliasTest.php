<?php

use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use gheith3\FileViewEntryPlugin\Infolists\Components\FileViewEntry;
use gheith3\FileViewEntryPlugin\View\FileViewEntryIconAlias;
use Illuminate\Support\HtmlString;

it('falls back to the stock Heroicons when no alias is registered', function (string $type, Heroicon $expected) {
    expect(FileViewEntry::make('files')->getFileIcon($type))->toBe($expected);
})->with([
    'image' => ['image', Heroicon::OutlinedPhoto],
    'video' => ['video', Heroicon::OutlinedVideoCamera],
    'audio' => ['audio', Heroicon::OutlinedMusicalNote],
    'pdf' => ['pdf', Heroicon::OutlinedDocumentText],
    'text' => ['text', Heroicon::OutlinedDocumentText],
    'document' => ['document', Heroicon::OutlinedDocument],
    'spreadsheet' => ['spreadsheet', Heroicon::OutlinedTableCells],
    'presentation' => ['presentation', Heroicon::OutlinedPresentationChartBar],
    'archive' => ['archive', Heroicon::OutlinedArchiveBox],
    'unknown' => ['other', Heroicon::OutlinedDocument],
]);

it('lets an alias registered by the host win over the stock icon of a file type', function (string $type, string $alias) {
    $icon = new HtmlString('<svg data-alias="'.$alias.'"></svg>');
    FilamentIcon::register([$alias => $icon]);

    expect(FileViewEntry::make('files')->getFileIcon($type))->toBe($icon);
})->with([
    'image' => ['image', FileViewEntryIconAlias::FILE_TYPES_IMAGE],
    'video' => ['video', FileViewEntryIconAlias::FILE_TYPES_VIDEO],
    'audio' => ['audio', FileViewEntryIconAlias::FILE_TYPES_AUDIO],
    'pdf' => ['pdf', FileViewEntryIconAlias::FILE_TYPES_PDF],
    'text' => ['text', FileViewEntryIconAlias::FILE_TYPES_TEXT],
    'document' => ['document', FileViewEntryIconAlias::FILE_TYPES_DOCUMENT],
    'spreadsheet' => ['spreadsheet', FileViewEntryIconAlias::FILE_TYPES_SPREADSHEET],
    'presentation' => ['presentation', FileViewEntryIconAlias::FILE_TYPES_PRESENTATION],
    'archive' => ['archive', FileViewEntryIconAlias::FILE_TYPES_ARCHIVE],
    'generic' => ['other', FileViewEntryIconAlias::FILE_TYPES_GENERIC],
]);

it('keeps customIcons() above a registered alias', function () {
    FilamentIcon::register([FileViewEntryIconAlias::FILE_TYPES_PDF => new HtmlString('<svg></svg>')]);

    $entry = FileViewEntry::make('files')->customIcons(['pdf' => 'heroicon-o-bolt']);

    expect($entry->getFileIcon('pdf'))->toBe('heroicon-o-bolt');
});
