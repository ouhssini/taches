<?php

// Database connection parameters
$host = 'localhost';
$dbname = 'Tasks';
$username = 'root';
$password = '199716';

// Create a MySQLi connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM tasks_list";
$result = $mysqli->query($sql);

$taches = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $taches[] = $row;
    }
}





if (isset($_POST['title'], $_POST['dated'], $_POST['datef']) && !empty($_POST['title']) && !empty($_POST['dated']) && !empty($_POST['datef'])) {

    try {
        $title = $_POST['title'];
        $dated = $_POST['dated'];
        $datef = $_POST['datef'];
        $query = "INSERT INTO tasks_list (title, start_date, end_date, isfinished) VALUES ('$title', '$dated', '$datef', 0)";
        $result = $mysqli->query($query);
        echo '<div class="container alert alert-success alert-dismissible fade show" role="alert">
        <strong>opla!</strong> votre neaveau task est ajoutez avec succeess
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } catch (Exception) {
        echo '<div class="container alert alert-danger alert-dismissible fade show" role="alert">
        <strong>OOps!</strong> la date de fin doit etre superieur de date de debut
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}


$mysqli->close();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GESTION DES TACHES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center my-4">GESTION DES TACHES</h1>
    <div class="container">
        <form action="" class="d-flex flex-column align-items-center" method='post'>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">Title</span>
                <input type="text" class="form-control" aria-label="title" aria-describedby="addon-wrapping" name="title">
            </div>
            <div class="row my-4 ">
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Date debut</span>
                        <input type="date" class="form-control" aria-label="datedebut" aria-describedby="addon-wrapping" name="dated">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Date Fin</span>
                        <input type="date" class="form-control" aria-label="datefin" aria-describedby="addon-wrapping" name="datef">
                    </div>
                </div>
                <div class="col">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>

        </form>
        <!-- taches table start here -->
        <div class="row">
            <table class="table table-striped ">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="align-middle">#</th>
                        <th scope="col" class="align-middle">Titre</th>
                        <th scope="col" class="align-middle">date debut</th>
                        <th scope="col" class="align-middle">date fin</th>
                        <th scope="col" class="align-middle">etat</th>
                        <th scope="col" class="align-middle">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taches as $key => $value) { ?>
                        <tr>
                        <td class="align-middle" hidden><?php echo $value["task_id"] ?></td>
                            <th scope="row" class="align-middle"><?php echo $key + 1 ?></th>
                            <td class="align-middle"><?php echo $value["title"] ?></td>
                            <td class="align-middle"><?php echo $value["start_date"] ?></td>
                            <td class="align-middle"><?php echo $value["end_date"] ?></td>
                            <td class="align-middle">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php if ($value["isfinished"] == 1) {
                                                                                                                                    echo "checked disabled";
                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Termine</label>
                                </div>
                            </td>
                            <td class="align-middle">
                                <button data-bs-toggle="modal" data-bs-target="#editModal" <?php if ($value["isfinished"] == 1) {
                                                                                                echo 'disabled class="btn btn-secondary"';
                                                                                            } else {
                                                                                                echo ' class="btn btn-warning"';
                                                                                            } ?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- modify task modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit task details -->
                    <form id="editTaskForm<?php echo $key; ?>">
                        <div class="mb-3">
                            <label for="editTitle<?php echo $key; ?>" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle<?php echo $key; ?>" name="editTitle" value="">
                        </div>
                        <div class="mb-3">
                            <label for="editDatedebut<?php echo $key; ?>" class="form-label">Date debut</label>
                            <input type="date" class="form-control" id="editDatedebut<?php echo $key; ?>" name="editDatedebut" value="">
                        </div>
                        <div class="mb-3">
                            <label for="editDatefin<?php echo $key; ?>" class="form-label">Date fin</label>
                            <input type="date" class="form-control" id="editDatefin<?php echo $key; ?>" name="editDatefin" value="">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="editCompleted<?php echo $key; ?>" name="editCompleted">
                            <label class="form-check-label" for="editCompleted<?php echo $key; ?>">Mark as Completed</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modify task modal -->


    <!-- delete task modal  -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $key; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel<?php echo $key; ?>">Delete Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this task?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete task modal  -->
    <script src="./assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>