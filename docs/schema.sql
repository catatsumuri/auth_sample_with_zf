CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT
  , account VARCHAR(255)
  , password VARCHAR(255)
  , UNIQUE(account)
);
INSET INTO user(null, "test1", "5a105e8b9d40e1329780d62ea2265d8a");
INSET INTO user(null, "test2", "ad0234829205b9033196ba818f7a872b");
