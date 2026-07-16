<?php

$users = [
    ['id' => 1, 'name' => 'Azura Mishimoto', 'role' => 'Admin', 'email' => 'azura@gmail.com', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Budi Santoso', 'role' => 'Admin', 'email' => 'budi.santoso@mail.com', 'status' => 'Active'],
    ['id' => 3, 'name' => 'Citra Dewi', 'role' => 'Admin', 'email' => 'citra.dewi@mail.com', 'status' => 'Active'],
    ['id' => 4, 'name' => 'Dewi Lestari', 'role' => 'Admin', 'email' => 'dewi.lestari@mail.com', 'status' => 'Inactive'],
];

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="layout-fixed fixed-header sidebar-expand-lg sidebar-collapse">
    <div class="app-wrapper">

        <?php include "../component/header.php"; ?>
        <?php
        $activePage = 'user';
        include "../component/sidebar.php";
        ?>

        <!-- Main Content -->

        <div class="app-main bg-body-tertiary">
            <div class="app-content p-3">

                <div class="content-header pe-3 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>Manage User</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item">
                                        <a href="../dashboard/dashboard.php" class="text-decoration-none">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a>Manage User</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container-fluid">

                    <div class="card">

                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <div class="input-group input-group-sm" style="max-width:250px;">
                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input id="searchInput" type="search" class="form-control"
                                        placeholder="Search User">
                                </div>

                                <a href="add.php" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i> Add User
                                </a>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="picTable" class="table table-striped table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($users as $i => $user): ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1; ?></td>
                                                <td><?= $user['name']; ?></td>
                                                <td><?= $user['email']; ?></td>
                                                <td><?= $user['role']; ?></td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge <?= $user['status'] === 'Active' ? 'text-bg-success' : 'text-bg-secondary'; ?>">
                                                        <?= $user['status']; ?>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action 
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item text-warning"
                                                                    href="edit.php?id=<?= $user['id']; ?>">
                                                                    <i class="bi bi-pencil-square me-1"></i> Edit</a></li>
                                                            <li><a class="dropdown-item text-danger" href="#">
                                                                    <i class="bi bi-trash me-1"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>

                                    </tbody>

                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span id="paginationText" class="small text-muted"></span>
                                <ul class="pagination pagination-sm mb-0" id="paginationControls"></ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include "../component/footer.php"; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const searchInput = document.getElementById("searchInput");

        const table = document.getElementById("picTable");
        const tbody = table.querySelector("tbody");

        const allRows = Array.from(tbody.querySelectorAll("tr"));

        const pageCtrl = document.getElementById("paginationControls");
        const pageTxt = document.getElementById("paginationText");

        const perPage = 10;
        let currentPage = 1;

        function getFilteredRows() {

            const keyword = searchInput.value.toLowerCase();

            return allRows.filter(row => {

                const text = row.textContent.toLowerCase();

                if (keyword && text.indexOf(keyword) === -1)
                    return false;

                return true;

            });

        }

        function render() {

            const filteredRows = getFilteredRows();

            const total = filteredRows.length;

            const pages = Math.max(1, Math.ceil(total / perPage));

            currentPage = Math.min(currentPage, pages);

            const start = (currentPage - 1) * perPage;

            allRows.forEach(row => {
                row.style.display = "none";
            });

            filteredRows
                .slice(start, start + perPage)
                .forEach((row, idx) => {
                    row.style.display = "";
                    row.cells[0].textContent = start + idx + 1;
                });

            pageTxt.textContent =
                total === 0
                    ? "No data avaiable"
                    : `Show ${start + 1}–${Math.min(start + perPage, total)} from ${total} data`;

            pageCtrl.innerHTML = "";

            function addPage(label, targetPage, opts = {}) {

                const li = document.createElement("li");

                li.className =
                    "page-item" +
                    (opts.active ? " active" : "") +
                    (opts.disabled ? " disabled" : "");

                if (opts.disabled) {
                    li.innerHTML = `<span class="page-link">${label}</span>`;
                } else {
                    li.innerHTML = `<a class="page-link" href="#">${label}</a>`;
                    li.addEventListener("click", e => {
                        e.preventDefault();
                        currentPage = targetPage;
                        render();
                    });
                }

                pageCtrl.appendChild(li);

            }

            addPage("Previous", currentPage - 1, { disabled: currentPage <= 1 });

            addPage("1", 1, { active: currentPage === 1 });

            if (currentPage > 3) {
                addPage("...", null, { disabled: true });
            }

            for (let p = Math.max(2, currentPage - 1); p <= Math.min(pages - 1, currentPage + 1); p++) {
                addPage(String(p), p, { active: currentPage === p });
            }

            if (currentPage < pages - 2) {
                addPage("...", null, { disabled: true });
            }

            if (pages > 1) {
                addPage(String(pages), pages, { active: currentPage === pages });
            }

            addPage("Next", currentPage + 1, { disabled: currentPage >= pages });

        }

        searchInput.addEventListener("input", () => {
            currentPage = 1;
            render();
        });

        render();
    </script>
</body>

</html>