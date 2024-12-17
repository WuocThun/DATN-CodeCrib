<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Not Found</title>
  <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
  background: #fff;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: #333;
}

.container {
  max-width: 600px;
  padding: 20px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  animation: fadeIn 1s ease-in-out;
}

h1 {
  font-size: 5rem;
  margin: 0;
  color: #ff6f61;
}

p {
  font-size: 1.2rem;
  margin: 15px 0;
  color: #666;
}

.home-button {
  display: inline-block;
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 1rem;
  text-decoration: none;
  background: #ff6f61;
  color: #fff;
  border-radius: 5px;
  transition: background 0.3s ease;
}

.home-button:hover {
  background: #e65b50;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>
<body>
  <div class="container">
    <h1>404</h1>
    <p>Oops! The page you're looking for doesn't exist.</p>
    <a href="index.html" class="home-button">Go Back Home</a>
  </div>
</body>
</html>
