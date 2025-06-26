<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/lab_automation_system/dashboard.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/lab_automation_system/modules/products/add_product.php">Add Product</a></li>
          <li class="nav-item"> <a class="nav-link" href="/lab_automation_system/modules/products/show_product.php">Show Product</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#testingMenu" aria-expanded="false" aria-controls="testingMenu">
        <i class="mdi mdi-flask-outline menu-icon"></i>
        <span class="menu-title">Testing</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="testingMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="/lab_automation_system/modules/test_types/add_test_type.php">Add Test Type</a></li>
          <li class="nav-item"><a class="nav-link" href="/lab_automation_system/modules/test_types/show_test_type.php">Show Test Type</a></li>
          <li class="nav-item"><a class="nav-link" href="/lab_automation_system/modules/tests/add_test.php">Add Testing Record</a></li>
          <li class="nav-item"><a class="nav-link" href="/lab_automation_system/modules/tests/show_test.php">Show Testing Record</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">Departments</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/lab_automation_system/modules/departments/add_department.php">Add Departments</a></li>
          <li class="nav-item"> <a class="nav-link" href="/lab_automation_system/modules/departments/show_department.php">Show Departments</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#productTestsMenu" aria-expanded="false" aria-controls="productTestsMenu">
        <i class="mdi mdi-flask-outline menu-icon"></i>
        <span class="menu-title">Product Tests</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="productTestsMenu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="/lab_automation_system/modules/product_test/add_product_test.php">Add Product Tests</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/lab_automation_system/modules/product_test/show_product_test.php">Show Product Tests</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="/lab_automation_system/report.php">
        <i class="mdi mdi-file-chart menu-icon"></i>
        <span class="menu-title">Reports</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/lab_automation_system/auth/logout.php">
        <i class="mdi mdi-logout menu-icon"></i>
        <span class="menu-title">Logout</span>
      </a>
    </li>
  </ul>
</nav>