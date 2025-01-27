package example;

import io.github.cdimascio.dotenv.Dotenv;
import redis.clients.jedis.DefaultJedisClientConfig;
import redis.clients.jedis.Jedis;

public class App {
    public String getGreeting() {
        return "Hello World!";
    }

    public static void main(String[] args) {

        Dotenv dotenv = Dotenv.configure()
                .directory("../../")
                .ignoreIfMalformed()
                .ignoreIfMissing()
                .load();

        String host = dotenv.get("REDIS_HOST");
        int port = Integer.valueOf(dotenv.get("REDIS_PORT"));
        String username = dotenv.get("REDIS_USERNAME");
        String password = dotenv.get("REDIS_PASSWORD");
        System.out.printf("host: %s%n", host);
        System.out.printf("port: %d%n", port);
        System.out.printf("username: %s%n", username);
        System.out.printf("password: %s%n", password);

        DefaultJedisClientConfig defaultJedisClientConfig = DefaultJedisClientConfig.builder()
                .user(username)
                .password(password)
                .build();

        try (Jedis jedis = new Jedis(host, port, defaultJedisClientConfig)) {
            String ping = jedis.ping();
            System.out.printf("ping: %s%n", ping);
        }
    }
}
