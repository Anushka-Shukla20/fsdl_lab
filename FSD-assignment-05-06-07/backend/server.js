require('dotenv').config();

const express = require('express');
const mongoose = require('mongoose');
const workoutRoutes = require('./routes/workouts');
const cors = require('cors');

const app = express();

// middleware
app.use(express.json());
app.use(cors());

// routes
app.use('/api/workouts', workoutRoutes);

// connect to db
mongoose.connect(process.env.MONGO_URI)
  .then(() => {
    console.log('connected to database');
    app.listen(process.env.PORT || 4000, () => {
      console.log(`listening on port ${process.env.PORT || 4000}`);
    });
  })
  .catch((err) => {
    console.error('connection error:', err);
  });