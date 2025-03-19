<link rel="stylesheet" href="css-nav.css">
<style>
.nav {
    background-color: #928DAB;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    font-family: 'Lato', sans-serif;
}

.welcome {
    text-align: center;
    margin-right: 20px;
    margin-left: -20px;
    padding: 10px 20px;
    background-color: #444;
    color: #FFFFFF; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    animation: lightCircle 5s infinite;
}

.welcome h1 {
    font-size: 36px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.links {
    display: flex;
    gap: 10px; 
}

.links a {
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    padding: 12px 20px;
    border-radius: 5px;
    transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
    font-family: 'Lato', sans-serif;
    color: rgb(255, 255, 255);
}

.links a:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
    color: #ffffff; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
}
</style>
 <div class="nav">
    <div class="welcome">
            <h1>SIS-G11</h1>
    </div>
    <div class="links">
        <div class="links" id="landingpage">
            <a href="index.php">Home</a>
        </div>
        <div class="links" id="classification">
            <a href="classification.php">Classification</a>
        </div>
        <div class="links" id="storage">
            <a href="storage.php">Storage</a>
        </div>
        <div class="links" id="viewtable">
            <a href="table.php">View Table</a>
        </div>
    </div>
    
</div>
