<?php

namespace Laraeast\LaravelBootstrapForms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BsFormController
{
    public function icon(Request $request): Response
    {
        $source = $request->query('source', 'default');
        $icon = $this->mimeTypeIcons()['default'];

        foreach ($this->mimeTypeIcons() as $type => $iconPath) {
            if ($type === $source) {
                $icon = $iconPath;
            }
        }

        $iconStream = file_get_contents($icon);

        return response($iconStream)->header('Content-Type', 'image/png');
    }

    protected function mimeTypeIcons(): array
    {
        $iconPath = __DIR__.'/../../assets/icons/';

        $mimeTypes = [
            'default' => $iconPath.'default.png',
            'upload' => $iconPath.'upload.png',
            ...array_fill_keys([
                'application/zip',
                'application/vnd.rar',
                'application/x-7z-compressed',
                'application/x-tar',
                'application/gzip',
                'application/x-bzip2',
                'application/x-xz',
                'application/x-lzma',
                'application/x-compress',
                'application/x-lzh-compressed',
                'application/vnd.ms-cab-compressed',
                'application/x-arj',
                'application/x-cpio',
            ], $iconPath.'zip.png'),
            ...array_fill_keys([
                'application/pdf',
                'application/x-pdf',
                'application/acrobat',
                'applications/vnd.pdf',
                'text/pdf',
                'text/x-pdf',
            ], $iconPath.'pdf.png'),
            ...array_fill_keys([
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/bmp',
                'image/webp',
                'image/svg+xml',
                'image/tiff',
                'image/x-icon',
                'image/heic',
                'image/avif',
                'image/vnd.adobe.photoshop',
                'image/vnd.microsoft.icon',
                'image/x-ms-bmp',
                'image/x-png',
                'image/x-cmu-raster',
                'image/x-xbitmap',
                'image/x-xpixmap',
                'image/x-xwindowdump',
                'image/x-portable-anymap',
                'image/x-portable-bitmap',
                'image/x-portable-graymap',
                'image/x-portable-pixmap',
                'image/x-rgb',
                'image/x-tga',
                'image/x-tiff',
            ], $iconPath.'image.png'),
            ...array_fill_keys([
                'audio/mpeg',
                'audio/wav',
                'audio/ogg',
                'audio/opus',
                'audio/aac',
                'audio/mp4',
                'audio/webm',
                'audio/flac',
                'audio/midi',
                'audio/amr',
                'audio/3gpp',
                'audio/x-wav',
                'audio/x-ms-wma',
                'audio/x-pn-realaudio',
                'audio/basic',
                'audio/vnd.wave',
                'audio/vnd.rip',
                'audio/x-aiff',
                'audio/x-mpegurl',
            ], $iconPath.'audio.png'),
            ...array_fill_keys([
                'video/webm',
                'video/ogg',
                'video/x-msvideo',
                'video/quicktime',
                'video/mpeg',
                'video/3gpp',
                'video/x-flv',
                'video/x-ms-wmv',
                'video/x-matroska',
                'video/MP2T',
                'video/x-ms-asf',
                'video/x-ms-wm',
                'video/x-ms-wmx',
                'video/x-ms-wvx',
                'video/avi',
                'video/divx',
                'video/avchd',
                'video/vnd.vivo',
                'video/vnd.rn-realvideo',
                'video/vnd.uvvu.mp4',
                'video/x-m4v',
            ], $iconPath.'video.png'),
        ];

        return array_merge($mimeTypes, config('laravel-bootstrap-forms.attachment.icons.mime-types', []));
    }
}
