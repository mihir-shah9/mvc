<nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand navbar"><b></b></a>
    <ul class="nav justify-content-end">

        <li class="nav-item" style="background-color: blue;">
            <a class="nav-link text-white" href="<?php echo $this->getUrl()->getUrl('grid', 'login', null, true); ?>"><b>LOGIN</b></a>
        </li>

        <li class="nav-item" style="background-color: green;">
            <a class="nav-link text-white" href="<?php echo $this->getUrl()->getUrl('grid', 'register', null, true); ?>"><b>REGISTER</b></a>
        </li>
    </ul>
</nav>


<nav class="navbar navbar-light bg-dark">
    <a class="navbar-brand navbar"><b>Web Application</b></a>
    <ul class="nav justify-content-end">


        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'admin', null, true); ?>').load();" href="javascript:void(0)"><i class="fa fa-lock" aria-hidden="true" style='color:red;'></i> Admin</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'attribute', null, true); ?>').load();" href="javascript:void(0)"><i class="fa fa-lock" aria-hidden="true" style='color:red;'></i> Attribute</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'category', null, true); ?>').load();" href="javascript:void(0)"><i class="fa fa-list-alt" style='color:red;'></i> Category</a>
        </li>


        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'customer', null, true); ?>').load();" href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true" style='color:red;'></i> Customer</a>
        </li>


        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'cgroup', null, true); ?>').load();" href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true" style='color:red;'></i> Customer-Group</a>
        </li>


        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'product', null, true); ?>').load();" href="javascript:void(0)"> Product</a>
        </li>


        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'shipping', null, true); ?>').load();" href="javascript:void(0)"><i class='fas fa-shipping-fast' style='color:red;'></i> Shipping</a>
        </li>


        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'payment', null, true); ?>').load();" href="javascript:void(0)"><i class="fa fa-shopping-cart" aria-hidden="true" style='color:red;'></i> Payment</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'cmspage', null, true); ?>').load();" href="javascript:void(0)"> CMS Page</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'brand', null, true); ?>').load();" href="javascript:void(0)"> Brand</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'config_group', null, true); ?>').load();" href="javascript:void(0)"> config_group</a>
        </li>
    </ul>
</nav>