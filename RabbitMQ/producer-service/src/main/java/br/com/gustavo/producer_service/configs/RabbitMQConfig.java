package br.com.gustavo.producer_service.configs;

import constants.RabbitMQConstants;
import org.springframework.amqp.core.Binding;
import org.springframework.amqp.core.BindingBuilder;
import org.springframework.amqp.core.DirectExchange;
import org.springframework.amqp.core.Queue;
import org.springframework.amqp.rabbit.connection.ConnectionFactory;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.amqp.support.converter.Jackson2JsonMessageConverter;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import static constants.RabbitMQConstants.*;

@Configuration
public class RabbitMQConfig {

    @Bean
    public Queue queue() {
        return new Queue(QUEUE_PRODUCT_LOG, false, false, false);
    }

    @Bean
    public DirectExchange directExchange() {
        return new DirectExchange(EXG_NAME_MARKETPLACE, false, false);
    }

    @Bean
    public Binding binding() {
        return BindingBuilder
                .bind(queue())
                .to(directExchange())
                .with(RK_PRODUCT_LOG);
    }

    // Conversor de objetos Java para JSON
    @Bean
    public Jackson2JsonMessageConverter messageConverter() {
        return new Jackson2JsonMessageConverter();
    }

    // Configuração do RabbitTemplate para utilizar JSON
    @Bean
    public RabbitTemplate rabbitTemplate(
            ConnectionFactory connectionFactory,
            Jackson2JsonMessageConverter messageConverter) {

        RabbitTemplate template = new RabbitTemplate(connectionFactory);
        template.setMessageConverter(messageConverter);

        return template;
    }
}
