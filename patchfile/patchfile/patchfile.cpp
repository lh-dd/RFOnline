#include <iostream>
#include <filesystem>
#include <string>
#include <cstring>
#include "include/miniz.h"

namespace fs = std::filesystem;

void zip_individual_file(const fs::path& base_folder, const fs::path& file_path) {
    mz_zip_archive zip;
    memset(&zip, 0, sizeof(zip));

    // compute relative path inside zip (after base folder)
    std::string relative_path = fs::relative(file_path, base_folder).string();
    std::replace(relative_path.begin(), relative_path.end(), '\\', '/');

    // zip filename: same directory as file, named <filename>.tmp
    fs::path zip_path = file_path.parent_path() / (file_path.filename().string() + ".tmp");

    if (!mz_zip_writer_init_file(&zip, zip_path.string().c_str(), 0)) {
        std::cerr << "Unable to open or create " << zip_path << std::endl;
        return;
    }

    if (!mz_zip_writer_add_file(&zip, relative_path.c_str(), file_path.string().c_str(), nullptr, 0, MZ_DEFAULT_COMPRESSION)) {
        std::cerr << "Failed to add " << file_path << " to " << zip_path << std::endl;
    }
    else {
        std::cout << "Zipped " << relative_path << " to " << zip_path << std::endl;
    }

    mz_zip_writer_finalize_archive(&zip);
    mz_zip_writer_end(&zip);
}

void create_individual_zips(const std::string& folder_path) {
    fs::path base_folder = folder_path;

    if (!fs::exists(base_folder) || !fs::is_directory(base_folder)) {
        std::cerr << base_folder << " does not exist or is not a directory!" << std::endl;
        return;
    }

    for (const auto& entry : fs::recursive_directory_iterator(base_folder)) {
        if (fs::is_regular_file(entry)) {
            if (entry.path().extension() == ".tmp") {
                continue; // skip .tmp files
            }
            zip_individual_file(base_folder, entry.path());
        }
    }
}

int main() {
    create_individual_zips("patch_folder"); // base folder
    return 0;
}
