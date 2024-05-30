particlesJS('particles-js', {
    particles: {
        number: {
            value: 100, // Adjust the number of snowflakes
            density: {
                enable: true,
                value_area: 800
            }
        },
        color: {
            value: '#ffffff' // Snowflake color
        },
        shape: {
            type: 'circle',
            stroke: {
                width: 0,
                color: '#000000'
            },
        },
        opacity: {
            value: 0.7,
            random: true,
            anim: {
                enable: true,
                speed: 1
            }
        },
        size: {
            value: 4,
            random: true
        },
        line_linked: {
            enable: false
        },
        move: {
            enable: true,
            speed: 3, // Adjust the snowflake falling speed
            direction: 'bottom',
            random: true,
            straight: false,
            out_mode: 'out',
            bounce: false
        }
    },
    interactivity: {
        detect_on: 'canvas',
        events: {
            onhover: {
                enable: false
            }
        }
    }
});
