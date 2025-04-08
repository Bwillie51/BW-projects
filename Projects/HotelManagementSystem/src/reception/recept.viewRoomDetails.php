<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Room Details</title>
    <link rel="stylesheet" href="../../config/styles/style.css">
    <script src="viewRoom.js" defer></script>
</head>
<body>
    <h1>View Room Details</h1>
    <form id="viewRoomForm">
        <label for="room_id">Enter Room ID:</label>
        <input type="number" id="room_id" name="room_id" required>
        <button type="submit">View Details</button>
    </form>
    <div id="roomDetails"></div>
</body>
</html>