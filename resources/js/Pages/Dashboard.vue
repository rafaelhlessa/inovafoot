<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LayoutGame from '@/Layouts/LayoutGame.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { reactive, ref } from 'vue';


const teamsSelect = reactive({
    teams: [],
    selectedTeam: '',
    showTeams: true,
    selectedTeamName: '',
    selectedTeamId: '',
    teamUser: []
});


// Função para buscar as equipes com championship_id === 4
const fetchTeams = async () => {
    try {
    const response = await axios.get('/api/teams');
    const data = response.data;
    
    teamsSelect.teams = data;

    await new Promise(resolve => setTimeout(resolve, 1000)); // Espera 2 segundos

    teamsSelect.teams.forEach(team => {
        
        if (team.championship_id === 4) {
            teamsSelect.teamUser.push(team);
        }
        
    });

        teamsSelect.showTeams = false;
        // Sortear uma equipe
        const randomIndex = Math.floor(Math.random() * teamsSelect.teamUser.length);
        
        teamsSelect.selectedTeamName = teamsSelect.teamUser[randomIndex].name;
        teamsSelect.selectedTeamId = teamsSelect.teamUser[randomIndex].id;    

  } catch (error) {
    console.error('Erro ao buscar equipes:', error);
  }
};

const form = {
    name: '',
};

const submit = async () => {
    // fetchTeams();
    try {
        console.log('Form data before submission:', form);
        

        // Validate form data
        if (!form.name) {
            console.error('Name field is empty');
            return;
        }

        const response = await axios.post('/api/managers', form);

        const update = await axios.put('api/teams/' + teamsSelect.selectedTeamId, {
            team_id: teamsSelect.selectedTeamId,
            manager_id: response.data.id,
        });

        // teamData = await axios.get(`/api/teams/${teamsSelect.selectedTeamId}`);

        // Redirect to the team show page
        window.location.href = `/api/teams/${teamsSelect.selectedTeamId}`;
        

        console.log('Response from server submit:', response.data);
    } catch (error) {
        alert('Erro ao salvar treinador', response.data);
        if (error.response) {
            // Server responded with a status other than 200 range
            console.error('Error response from server:', error.response.data);
        } else if (error.request) {
            // Request was made but no response received
            console.error('No response received:', error.request);
        } else {
            // Something happened in setting up the request
            console.error('Error setting up request:', error.message);
        }
    }
};

</script>

<template>
    <Head title="Escolher Equipe" />

    <LayoutGame>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Escolha de Equipe</h2>
        </template>

        <div class="flex min-h-full flex-1 flex-col justify-center py-8 sm:px-6 lg:px-6">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Aqui começa sua jornada.</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome do Treinador</label>
                    <div class="mt-2">
                    <input id="name" name="name" type="name" autocomplete="name" v-model="form.name" required="" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>

                <div>
                    <button @click.prevent="fetchTeams" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sortear Time</button>
                </div>

                <div>
                    <div>{{ teamsSelect.selectedTeamName }}</div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                    
                    </div>
                </div>

                <div>
                    <button type="submit"  class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Jogar</button>

                </div>
                </form>
            </div>
            </div>
        </div>
    </LayoutGame>
</template>
