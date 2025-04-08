<!DOCTYPE html>
<html lang="en">
<head>
    <title>Request Room Service</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
    <h1>Request Room Service</h1>
    <form action="requestService.php" method="POST">
        <label for="service">Select Service:</label>
        <select id="service" name="service" required>
            <option value="towels">Towels</option>
            <option value="soap">Soap</option>
            <option value="toiletries">Toiletries</option>
            <option value="laundry">Laundry</option>
        </select><br>

        <button type="submit">Request</button>
    </form>
</body>
</html>