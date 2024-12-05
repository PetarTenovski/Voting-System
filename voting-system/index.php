<?php
require 'Database.php';
require 'Authentication.php';

$db = (new Database())->connect();
$auth = new Auth($db);

session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Voting System</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <header>
        <div class="header-section">
            <?php if (isset($_SESSION['employee_id'])): ?>
                <div class="logo">
                    <span class="user">Welcome, <?= htmlspecialchars($_SESSION['employee_name']); ?>! </span>
                    <a class="logout" href="logout.php">Logout</a>
                </div>
            <?php else: ?>
                <p><a class="login" href="login.php">Login</a> <a class="register" href="register.php">Register</a></p>
            <?php endif; ?>
        </div>
    </header>
<div class="content">
<h1>Employee Voting System</h1>

<?php
require 'Employee.php';
require 'Vote.php';

$employeeModel = new Employee($db);
$voteModel = new Vote($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['employee_id'])) {
        $voter_id = $_SESSION['employee_id']; 
        $nominee_id = $_POST['nominee_id'];
        $category = $_POST['category'];
        $comment = $_POST['comment'];
        $message = $voteModel->addVote($voter_id, $nominee_id, $category, $comment);
        echo $message;
    } else {
        echo "You must be logged in to vote.";
    }
}

$employees = $employeeModel->getAllEmployees();
$results = $voteModel->getResults();
$mostActiveVoters = $voteModel->getMostActiveVoters();
?>

<?php if (isset($_SESSION['employee_id'])): ?>
  
    <form method="POST">
        <label for="nominee">Nominee:</label>
        <select class="select" name="nominee_id" required>
            <?php foreach ($employees as $employee) { ?>
    
                <?php if ($employee['id'] !== $_SESSION['employee_id']) { ?>
                    <option value="<?= $employee['id'] ?>"><?= htmlspecialchars($employee['name']); ?></option>
                <?php } ?>
            <?php } ?>
        </select>

        <label for="category">Category:</label>
        <select name="category" required>
            <option value="Makes Work Fun">Makes Work Fun</option>
            <option value="Team Player">Team Player</option>
            <option value="Culture Champion">Culture Champion</option>
            <option value="Difference Maker">Difference Maker</option>
        </select>

        <label for="comment">Comment:</label>
        <textarea name="comment" required></textarea>

        <button type="submit">Submit</button>
    </form>
<?php endif; ?>




<?php 
$votesData = $voteModel->getVotesByCategoryAndEmployee();

$pivotTable = [];
$categories = [];

foreach ($votesData as $row) {
    $employee = $row['employee_name'];
    $category = $row['category'];
    $totalVotes = $row['total_votes'];

    if (!isset($pivotTable[$employee])) {
        $pivotTable[$employee] = [];
    }

    $pivotTable[$employee][$category] = $totalVotes;
    if (!in_array($category, $categories)) {
        $categories[] = $category;
    }
}

if (!empty($pivotTable)) {
    echo "<h2>All Votes by Category</h2>";
    echo "<table class='content-table'>";
    echo "<tr><th>Employee Name</th>";

    foreach ($categories as $category) {
        echo "<th>" . htmlspecialchars($category) . "</th>";
    }
    echo "</tr>";

    foreach ($pivotTable as $employee => $votes) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($employee) . "</td>";

        foreach ($categories as $category) {
            echo "<td>" . (isset($votes[$category]) ? htmlspecialchars($votes[$category]) : '0') . "</td>";
        }

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No votes have been cast yet.</p>";
}

?>

<?php 

$topVotes = $voteModel->getTopNomineesByCategory();

if(!empty($topVotes)){
    echo "<h2>Top Nominees By Category</h2>";
    echo "<table class='content-table'>";
    echo "<tr><th>Employee Name</th><th>Category</th><th>Total Votes</th>";
    foreach ($topVotes as $topEmployee){
        echo "<tr>";
        echo "<td>" . htmlspecialchars($topEmployee['nominee_name']) . "</td>";
        echo "<td>" . htmlspecialchars($topEmployee['category']) . "</td>";
        echo "<td>" . htmlspecialchars($topEmployee['total_votes']) . "</td>";
        echo "</tr>";
    }
}

?>
</div>
</body>
</html>
