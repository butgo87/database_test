@Grapes([
    @Grab('io.github.cdimascio:dotenv-java:3.1.0'),
    @Grab('redis.clients:jedis:5.2.0')
])
import redis.clients.jedis.Jedis;

println "aaaaaaa"
def v = 65
printf "%s\n", v