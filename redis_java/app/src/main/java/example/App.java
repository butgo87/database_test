package example;

import io.github.cdimascio.dotenv.Dotenv;
import redis.clients.jedis.DefaultJedisClientConfig;
import redis.clients.jedis.Jedis;

public class App {

    private final Jedis jedisConnection;

    public App() {
        this.jedisConnection = createJedisConnection();
    }

    private Jedis createJedisConnection() {
        Dotenv dotenv = Dotenv.configure()
                .directory("../../")
                .ignoreIfMalformed()
                .ignoreIfMissing()
                .load();

        String host = dotenv.get("REDIS_HOST");
        int port = Integer.parseInt(dotenv.get("REDIS_PORT"));
        String username = dotenv.get("REDIS_USERNAME");
        String password = dotenv.get("REDIS_PASSWORD");
        System.out.printf("host: %s%n", host);
        System.out.printf("port: %d%n", port);
        System.out.printf("username: %s%n", username);
        System.out.printf("password: %s%n", password);

        DefaultJedisClientConfig jedisClientConfig = DefaultJedisClientConfig.builder()
                .user(username)
                .password(password)
                .build();

        return new Jedis(host, port, jedisClientConfig); // Jedis 인스턴스 생성
    }

    public void ping() {
        String ping = jedisConnection.ping();
        System.out.printf("ping: %s%n", ping);
    }

    public static void main(String[] args) {

        App app = new App();

        app.ping();
    }
}
