module.exports = {
    HOST: "localhost",
    USER: "mat",
    PASSWORD: "root",
    DB: "yowl",
    dialect: "mysql",
    pool: {
      max: 5,
      min: 0,
      acquire: 30000,
      idle: 10000
    }
  };