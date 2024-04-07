<!-- Praktikum 3. Folder Template Langkah 4 menu.php -->
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <!-- Sidebar untuk menampilkan menu aplikasi -->

    <!-- Offcanvas menu untuk versi medium dan lebih besar -->
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <!-- Header offcanvas -->
        <div class="offcanvas-header">
            <!-- Judul sidebar -->
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Aplikasi Kantor Siapa</h5>
            <!-- Tombol close untuk menutup offcanvas -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>

        <!-- Body offcanvas -->
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <!-- Daftar menu -->
            <ul class="nav flex-column">
                <!-- Menu Dashboard -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="index.php">
                        <!-- Icon untuk Dashboard -->
                        <svg class="bi">
                            <use xlink:href="#house-fill" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <!-- Menu Anggota -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=anggota">
                        <!-- Icon untuk Anggota -->
                        <svg class="bi">
                            <use xlink:href="#people" />
                        </svg>
                        Anggota
                    </a>
                </li>

                <!-- Menu Jabatan -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=jabatan">
                        <!-- Icon untuk Jabatan -->
                        <svg class="bi">
                            <use xlink:href="#puzzle" />
                        </svg>
                        Jabatan
                    </a>
                </li>
            </ul>

            <!-- Garis pemisah -->
            <hr class="my-3">

            <!-- Daftar menu tambahan -->
            <ul class="nav flex-column mb-auto">
                <!-- Menu Settings -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <!-- Icon untuk Settings -->
                        <svg class="bi">
                            <use xlink:href="#gear-wide-connected" />
                        </svg>
                        Settings
                    </a>
                </li>

                <!-- Menu Log out -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="logout.php">
                        <!-- Icon untuk Log out -->
                        <svg class="bi">
                            <use xlink:href="#door-closed" />
                        </svg>
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>