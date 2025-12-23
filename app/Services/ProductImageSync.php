<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductImageSync
{
    /**
     * Sync image file to the job portal application storage
     *
     * @param string $imagePath The relative path to the image (e.g., 'products/filename.png')
     * @return bool True if successful, false otherwise
     */
    public static function syncImage(string $imagePath): bool
    {
        try {
            $filename = basename($imagePath);

            // Source path (current admin storage)
            $sourceFile = storage_path('app/public/' . $imagePath);

            // Destination path (JobAway frontend)
            $destDir = base_path('../JobAway/storage/app/public/products');
            $destFile = $destDir . '/' . $filename;

            // Create destination directory if it doesn't exist
            if (!File::exists($destDir)) {
                File::makeDirectory($destDir, 0755, true);
            }

            // Copy file if source exists
            if (File::exists($sourceFile)) {
                File::copy($sourceFile, $destFile);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            \Log::error('Product Image Sync Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sync multiple image files
     *
     * @param array $imagePaths Array of image paths to sync
     * @return int Number of successfully synced images
     */
    public static function syncImages(array $imagePaths): int
    {
        $syncedCount = 0;

        foreach ($imagePaths as $imagePath) {
            if (self::syncImage($imagePath)) {
                $syncedCount++;
            }
        }

        return $syncedCount;
    }

    /**
     * Delete image from JobAway frontend storage
     *
     * @param string $imagePath The relative path to the image
     * @return bool True if successful, false otherwise
     */
    public static function deleteImage(string $imagePath): bool
    {
        try {
            $filename = basename($imagePath);
            $destFile = base_path('../JobAway/storage/app/public/products/' . $filename);

            if (File::exists($destFile)) {
                File::delete($destFile);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            \Log::error('Product Image Delete Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete multiple images from JobAway frontend storage
     *
     * @param array $imagePaths Array of image paths to delete
     * @return int Number of successfully deleted images
     */
    public static function deleteImages(array $imagePaths): int
    {
        $deletedCount = 0;

        foreach ($imagePaths as $imagePath) {
            if (self::deleteImage($imagePath)) {
                $deletedCount++;
            }
        }

        return $deletedCount;
    }
}
