// app.js - JavaScript for Theme Park Planner
// Christopher Boartfield
// CPSC 5210 - Final Project
// This file contains all the JavaScript logic for fetching and rendering rides, handling filters, and managing the user's itinerary.

document.addEventListener('DOMContentLoaded', () => {
    const currentPage = window.location.pathname.split('/').pop();
    if (currentPage === 'index.php') {
        document.getElementById('filter-button').addEventListener('click', loadRides);
        loadRides();
    } else if (currentPage === 'itinerary.php') {
        loadItinerary();
    }
});

// showToast(message) - displays a brief toast notification at the bottom right
function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.remove('hidden', 'fade-out');

    setTimeout(() => {
        toast.classList.add('fade-out');
        setTimeout(() => toast.classList.add('hidden'), 500);
    }, 2500);
}

// loadRides() - builds query params from filters and fetches get_rides.php
function loadRides() {
    const spinner = document.getElementById('spinner');
    spinner.classList.remove('hidden');
    document.getElementById('ride-list').innerHTML = '';

    let params = new URLSearchParams();
    const park     = document.getElementById('park-select').value;
    const thrill   = document.getElementById('thrill-level-select').value;
    const maxWait  = document.getElementById('max-wait-time').value;

    if (park)    params.append('park', park);
    if (thrill)  params.append('thrill', thrill);
    if (maxWait) params.append('max_wait', maxWait);

    fetch('get_rides.php?' + params.toString())
        .then(response => response.json())
        .then(rides => {
            spinner.classList.add('hidden');
            renderRides(rides);
        })
        .catch(err => {
            spinner.classList.add('hidden');
            console.error('Error loading rides:', err);
        });
}

// renderRides(rides) - loops through rides array and builds HTML cards
function renderRides(rides) {
    let rideList = document.getElementById('ride-list');
    rideList.innerHTML = '';

    if (rides.length === 0) {
        rideList.innerHTML = '<p>No rides found matching your filters.</p>';
        return;
    }

    rides.forEach(ride => {
        let thrillClass = 'thrill-' + ride.thrill_level.toLowerCase();
        let card = document.createElement('div');
        card.className = 'ride-card';
        card.innerHTML = `
            <h3>${ride.name}</h3>
            <p><strong>Park:</strong> ${ride.park}</p>
            <p><strong>Thrill Level:</strong> <span class="${thrillClass}">${ride.thrill_level}</span></p>
            <p><strong>Wait Time:</strong> ${ride.wait_time} min</p>
            <p>${ride.description}</p>
            <button class="add-btn" onclick="addToItinerary(${ride.id})">Add to Itinerary</button>
        `;
        rideList.appendChild(card);
    });
}

// addToItinerary(rideId) - POSTs to add_itinerary.php with user_id and ride_id
function addToItinerary(rideId) {
    fetch('add_itinerary.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: USER_ID, ride_id: rideId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('✨ Ride added to your itinerary!');
        } else {
            showToast(data.error || 'Could not add ride.');
        }
    })
    .catch(err => console.error('Error adding to itinerary:', err));
}

// loadItinerary() - fetches get_itinerary.php with user_id
function loadItinerary() {
    let params = new URLSearchParams();
    params.append('user_id', USER_ID);

    fetch('get_itinerary.php?' + params.toString())
        .then(response => response.json())
        .then(rides => renderItinerary(rides))
        .catch(err => console.error('Error loading itinerary:', err));
}

// renderItinerary(rides) - loops through rides and builds itinerary cards
function renderItinerary(rides) {
    let itineraryList = document.getElementById('itinerary-list');
    itineraryList.innerHTML = '';

    if (rides.length === 0) {
        itineraryList.innerHTML = '<p>Your itinerary is empty. <a href="index.php">Browse rides</a> to add some!</p>';
        return;
    }

    rides.forEach(ride => {
        let thrillClass = 'thrill-' + ride.thrill_level.toLowerCase();
        let card = document.createElement('div');
        card.className = 'ride-card';
        card.innerHTML = `
            <h3>${ride.name}</h3>
            <p><strong>Park:</strong> ${ride.park}</p>
            <p><strong>Thrill Level:</strong> <span class="${thrillClass}">${ride.thrill_level}</span></p>
            <p><strong>Wait Time:</strong> ${ride.wait_time} min</p>
            <p>${ride.description}</p>
            <button class="remove-btn" onclick="removeFromItinerary(${ride.id})">Remove</button>
        `;
        itineraryList.appendChild(card);
    });
}

// removeFromItinerary(rideId) - POSTs to remove_itinerary.php then reloads itinerary
function removeFromItinerary(rideId) {
    fetch('remove_itinerary.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: USER_ID, ride_id: rideId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('🗑️ Ride removed from your itinerary.');
            loadItinerary();
        } else {
            showToast(data.error || 'Could not remove ride.');
        }
    })
    .catch(err => console.error('Error removing from itinerary:', err));
}
