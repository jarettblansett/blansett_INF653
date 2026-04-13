const express = require('express');
const path = require('path');
const { logEvents } = require('./middleware/logger');
const errorHandler = require('./middleware/errorHandler');

const app = express();

// Logger middleware
app.use((req, res, next) => {
    logEvents(`${req.method} ${req.url}`);
    next();
});

// Serve static files from /views
app.use(express.static(path.join(__dirname, 'views')));

// Serve JSON files from /data
app.use('/data', express.static(path.join(__dirname, 'data')));

// Test route that throws an error
app.get('/cause-error', (req, res, next) => {
    next(new Error("Intentional test error!"));
});

// Error handler MUST be last
app.use(errorHandler);

app.listen(3000, () => console.log('Server running on http://localhost:3000'));
