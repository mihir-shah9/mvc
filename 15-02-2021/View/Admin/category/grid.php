<?php
$categories = $this->getCategories();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <link rel="stylesheet" href="../15-02-2021/form.css">
</head>

<body class="grid">
    <div class="container" style="margin-bottom: 250px; margin-left: 35px;">

        <button type="button" class="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form', null, null, true); ?>').load();">Create Category</button>

        <table class="table mt-3 table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>Id</th>
                    <th>ParentId</th>
                    <th>PathId</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($categories) : ?>
                    <?php foreach ($categories->getData() as $category) : ?>
                        <tr class="text-center">
                            <td><?php echo $category->id; ?></td>
                            <td><?php echo $category->parentId; ?></td>
                            <td><?php echo $category->pathId; ?></td>
                            <td><?php echo $this->getName($category); ?></td>
                            <td><?php echo $category->status; ?></td>
                            <td><?php echo $category->description; ?></td>
                            <td>
                                <button class="btn btn-danger" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit', null, ['id' => $category->id], true); ?>').load();">Edit</button>

                                <button class="btn btn-dark" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete', null, ['id' => $category->id], true); ?>').removeParam().load();">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>