<?php

declare(strict_types=1);

namespace gheith3\FileViewEntryPlugin\View;

/**
 * Icon aliases this package resolves, so a host can re-icon the file view globally instead of
 * publishing the view. Register them exactly as Filament's own:
 *
 * ```php
 * use Filament\Support\Facades\FilamentIcon;
 * use gheith3\FileViewEntryPlugin\View\FileViewEntryIconAlias;
 *
 * FilamentIcon::register([
 *     FileViewEntryIconAlias::FILE_TYPES_PDF => Phosphor::FilePdf,
 * ]);
 * ```
 *
 * The string values are part of the public contract — a host registers against them — so they may
 * not be renamed without a breaking release. They share the package's view namespace, which is what
 * keeps them from colliding with another package's aliases.
 *
 * `customIcons()` on an entry still wins over a registered file-type alias: the alias is the
 * default, the per-entry modifier is the exception.
 */
class FileViewEntryIconAlias
{
    /** An image file. */
    const FILE_TYPES_IMAGE = 'file-view-entry-plugin::file-types.image';

    /** A video file. */
    const FILE_TYPES_VIDEO = 'file-view-entry-plugin::file-types.video';

    /** An audio file. */
    const FILE_TYPES_AUDIO = 'file-view-entry-plugin::file-types.audio';

    /** A PDF file. */
    const FILE_TYPES_PDF = 'file-view-entry-plugin::file-types.pdf';

    /** A plain text file. */
    const FILE_TYPES_TEXT = 'file-view-entry-plugin::file-types.text';

    /** A word-processing document. */
    const FILE_TYPES_DOCUMENT = 'file-view-entry-plugin::file-types.document';

    /** A spreadsheet. */
    const FILE_TYPES_SPREADSHEET = 'file-view-entry-plugin::file-types.spreadsheet';

    /** A presentation. */
    const FILE_TYPES_PRESENTATION = 'file-view-entry-plugin::file-types.presentation';

    /** An archive. */
    const FILE_TYPES_ARCHIVE = 'file-view-entry-plugin::file-types.archive';

    /** Any file whose type the package does not recognise. */
    const FILE_TYPES_GENERIC = 'file-view-entry-plugin::file-types.generic';

    /** The file shown in place of one that no longer exists on the disk. */
    const STATES_FILE_NOT_FOUND = 'file-view-entry-plugin::states.file-not-found';

    /** Closes the preview modal. */
    const ACTIONS_CLOSE = 'file-view-entry-plugin::actions.close';

    /** Opens the file in a new tab. */
    const ACTIONS_OPEN = 'file-view-entry-plugin::actions.open';

    /** Copies the link to the file. */
    const ACTIONS_COPY_LINK = 'file-view-entry-plugin::actions.copy-link';

    /** Downloads the file. */
    const ACTIONS_DOWNLOAD = 'file-view-entry-plugin::actions.download';

    /** Opens the preview modal (the eye button). */
    const ACTIONS_PREVIEW = 'file-view-entry-plugin::actions.preview';
}
