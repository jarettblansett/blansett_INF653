const { logEvents } = require('./logger');

const errorHandler = (err, req, res, next) => {
    logEvents(`${err.name}: ${err.message}`);
    console.error(err.stack);

    res.status(500).json({
        message: err.message,
        status: 500
    });
};

module.exports = errorHandler;
