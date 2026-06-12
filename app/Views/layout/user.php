<?php helper(['url']); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard - Absensi</title>

    <!-- AdminLTE + Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Modern Styling -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --secondary-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --soft-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            --hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --bg-body: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
        }

        .content-wrapper {
            background-color: var(--bg-body) !important;
        }

        /* Modern Card */
        .card-modern {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: var(--soft-shadow);
            transition: all 0.3s ease;
        }
        .card-modern:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-2px);
        }

        /* Buttons */
        .btn-modern {
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 24px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            color: white;
        }
        
        .btn-primary-gradient { background: var(--primary-gradient); color: white; }
        .btn-success-gradient { background: var(--secondary-gradient); color: white; }
        .btn-warning-gradient { background: var(--warning-gradient); color: white; }
        .btn-danger-gradient { background: var(--danger-gradient); color: white; }

        /* Sidebar Styling */
        .main-sidebar {
            background: #0f172a !important; /* Slate 900 */
        }
        .brand-link {
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background: var(--primary-gradient) !important;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
            border-radius: 10px;
        }
        .nav-pills .nav-link {
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.2s;
        }

        /* Form Inputs */
        .form-control-modern {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            background-color: #f8fafc;
            transition: all 0.2s;
            height: auto;
        }
        .form-control-modern:focus {
            background-color: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        /* Table */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0 8px;
            width: 100%;
        }
        .table-modern th {
            border-top: none;
            border-bottom: none !important;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 16px;
        }
        .table-modern td {
            border-top: none;
            background: white;
            padding: 16px;
            vertical-align: middle;
        }
        .table-modern td:first-child { border-top-left-radius: 12px; border-bottom-left-radius: 12px; }
        .table-modern td:last-child { border-top-right-radius: 12px; border-bottom-right-radius: 12px; }
        .table-modern tr {
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            transition: transform 0.2s;
        }
        .table-modern tr:hover {
            transform: scale(1.01);
            box-shadow: var(--soft-shadow);
        }

        /* Badges */
        .badge-modern {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        .badge-warning-soft { background: #fef3c7; color: #d97706; }
        .badge-success-soft { background: #d1fae5; color: #059669; }
        .badge-danger-soft { background: #fee2e2; color: #dc2626; }
        .badge-primary-soft { background: #e0e7ff; color: #4f46e5; }
        
        /* Layout Tweaks */
        .navbar-white { background: var(--glass-bg) !important; backdrop-filter: blur(10px); border-bottom: 1px solid var(--glass-border) !important; }
    /* ================= MOBILE RESPONSIVE ================= */

@media (max-width: 768px) {

    .main-sidebar {
        width: 250px !important;
    }

    .content-wrapper {
        padding: 10px !important;
    }

    .card-modern {
        border-radius: 12px;
        margin-bottom: 12px;
    }

    .btn-modern {
        width: 100%;
        margin-bottom: 10px;
        font-size: 14px;
        padding: 10px;
    }

    .table-modern {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .navbar-nav .nav-item span {
        font-size: 13px;
    }

    .brand-text {
        font-size: 16px;
    }

    h1, h2, h3, h4 {
        font-size: 20px !important;
    }

    .small-box h3 {
        font-size: 20px;
    }

    .main-footer {
        font-size: 12px;
    }

    .content-header h1 {
        font-size: 22px;
    }

}
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
                <span class="text-dark">
                    👤 
                    <?php
                        $username = session()->get('username');
                        echo $username ? $username : 'User';
                    ?>
                </span>
            </li>

            <li class="nav-item">
                <a href="<?= site_url('logout') ?>" class="btn btn-danger btn-sm">
                    Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- SIDEBAR -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="<?= base_url('dashboard') ?>" class="brand-link text-center">
            <span class="brand-text font-weight-light">ABSENSI APP</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">

                    <!-- DASHBOARD -->
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard') ?>" 
                           class="nav-link <?= service('uri')->getSegment(1) == 'dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- ABSENSI -->
                    <li class="nav-item">
                        <a href="<?= base_url('absensi') ?>" 
                           class="nav-link <?= service('uri')->getSegment(1) == 'absensi' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>Absensi</p>
                        </a>
                    </li>

                    <!-- CUTI -->
                    <li class="nav-item">
                        <a href="<?= base_url('cuti') ?>" 
                           class="nav-link <?= service('uri')->getSegment(1) == 'cuti' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>Cuti Saya</p>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- CONTENT -->
    <div class="content-wrapper p-3">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- FOOTER -->
    <footer class="main-footer text-center">
        <strong>Absensi App &copy; <?= date('Y'); ?></strong>
    </footer>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>