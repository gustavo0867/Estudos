<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Aluno</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        form {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        button {
            background-color: #ff7f50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff6347;
        }
    </style>
</head>
<body>
    <h1>Cadastrar Novo Aluno</h1>

    <form action="{{ url('/cadastrar') }}" method="POST" id="cadastroForm">
        @csrf

        <label for="dia_semana">Dia da Semana:</label>
        <select name="dia_semana" required>
            <option value="segunda">Segunda-feira</option>
            <option value="terça">Terça-feira</option>
            <option value="quarta">Quarta-feira</option>
            <option value="quinta">Quinta-feira</option>
            <option value="sexta">Sexta-feira</option>
            <option value="sábado">Sábado</option>
        </select>

        <label for="horario">Horário:</label>
        <select name="horario" id="horario" required>
            <option value="09:00-11:00" class="weekday">09:00 - 11:00</option>
            <option value="13:00-15:00" class="weekday">13:00 - 15:00</option>
            <option value="15:00-17:00" class="weekday">15:00 - 17:00</option>
            <option value="08:00-10:00" class="saturday">08:00 - 10:00</option>
            <option value="10:00-12:00" class="saturday">10:00 - 12:00</option>
        </select>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const diaSemanaSelect = document.querySelector('select[name="dia_semana"]');
            const horarioSelect = document.querySelector('select[name="horario"]');
            const weekdayOptions = horarioSelect.querySelectorAll('.weekday');
            const saturdayOptions = horarioSelect.querySelectorAll('.saturday');

            function updateHorarioOptions() {
                const selectedDay = diaSemanaSelect.value;
                if (selectedDay === 'sábado') {
                weekdayOptions.forEach(option => option.style.display = 'none');
                saturdayOptions.forEach(option => option.style.display = 'block');
                } else {
                weekdayOptions.forEach(option => option.style.display = 'block');
                saturdayOptions.forEach(option => option.style.display = 'none');
                }
            }

            diaSemanaSelect.addEventListener('change', updateHorarioOptions);
            updateHorarioOptions(); // Initial call to set the correct options on page load
            });
        </script>

        <label for="nome_aluno">Nome do Aluno:</label>
        <input type="text" name="nome_aluno" required>

        <label for="curso">Curso:</label>
        <select name="curso" id="curso" required>
            <option value="first">First</option>
            <option value="onebot">Onebot</option>
            <option value="techbot">Tech</option>
            <option value="autobo">Autobot</option>
            <option value="gamebot">Gamebot</option>
            <option value="gamebotadv">Gamebot Advanced</option>
            <option value="gamebotexp">Gamebot Expert</option>
            <option value="aibot">Aibot</option>
            <option value="aibotadv">Aibot Advanced</option>
            <option value="developer">App Developer</option>
        </select>

        <label for="instagram">Instagram (opcional):</label>
        <input type="text" name="instagram" placeholder="@">

        <label for="tipo">Tipo de Aula:</label>
        <select name="tipo" required>
            <option value="regular">Aula Regular</option>
            <option value="experimental">Aula Experimental</option>
            <option value="reposicao">Aula de Reposição</option>
        </select>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" rows="4" style="width: 100%; padding: 10px; margin: 10px 0; border: none; border-radius: 5px;"></textarea>

        <button type="submit">Cadastrar</button>
    </form>

    <br><br>
    <a href="{{ url('/') }}">
        <button>Voltar ao Cronograma</button>
    </a>  
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cursoSelect = document.querySelector('select[name="curso"]');
            const horarioSelect = document.querySelector('select[name="horario"]');
            const form = document.getElementById('cadastroForm');

            const courseLimits = {
                'first': 5,
                'onebot': 5,
                'techbot': 3,
                'autobo': 2,
                'gamebot': 2,
                'gamebotadv': 7,
                'gamebotexp': 7,
                'aibot': 1,
                'aibotadv': 1,
                'developer': 7
            };

            async function checkCourseLimit() {
                const curso = cursoSelect.value;
                const horario = horarioSelect.value;
                if (curso && horario) {
                    const response = await fetch(`/check-course-limit?curso=${curso}&horario=${horario}`);
                    const data = await response.json();
                    const totalStudents = data.totalCount;
                    const courseStudents = data.courseCount;

                    console.log(`Total students: ${totalStudents}, Course students: ${courseStudents}`);

                    if (totalStudents >= 7) {
                        alert(`O limite geral de alunos para o horário ${horario} foi atingido.`);
                        return false;
                    } else if (courseStudents >= courseLimits[curso]) {
                        alert(`O limite de alunos para o curso ${curso} neste horário foi atingido.`);
                        return false;
                    }
                }
                return true;
            }

            cursoSelect.addEventListener('change', checkCourseLimit);
            horarioSelect.addEventListener('change', checkCourseLimit);

            form.addEventListener('submit', async function (event) {
                event.preventDefault(); // Prevent form submission initially
                const isValid = await checkCourseLimit();
                if (isValid) {
                    console.log('Form is valid, submitting...');
                    form.submit(); // Submit the form if validation passes
                } else {
                    console.log('Form is not valid, not submitting.');
                }
            });
        });
    </script>

</body>
</html>
