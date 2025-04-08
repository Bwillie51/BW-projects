
document.getElementById('viewRoomForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const roomId = document.getElementById('room_id').value;

    fetch(`viewRoom.php?room_id=${roomId}`)
        .then(response => response.json())
        .then(data => {
            const roomDetails = document.getElementById('roomDetails');
            if (data.error) {
                roomDetails.innerHTML = `<p>${data.error}</p>`;
            } else {
                roomDetails.innerHTML = `
                    <p>Room Number: ${data.room_number}</p>
                    <p>Type: ${data.type}</p>
                    <p>Status: ${data.status}</p>
                    <p>Price: ${data.price}</p>
                    <p>Customer Name: ${data.customer_name || 'N/A'}</p>
                `;
            }
        });
});