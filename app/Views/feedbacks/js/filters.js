document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.feedback-card');

    // Funções de filtro: recebem o card e o valor do filtro, retornam true (mostrar) ou false (esconder)
    const filtros = {
        nps: (card, valor) => {
            if (!valor) return true; // sem filtro aplicado
            const nps = parseInt(card.dataset.nps);
            if (valor === 'positivo') {
                return !isNaN(nps) && nps >= 9;
            }
            return true; // outros valores podem ser tratados depois
        },
        csat: (card, valor) => {
            if (!valor) return true;
            const csat = parseInt(card.dataset.csat);
            if (valor === 'positivo') {
                return !isNaN(csat) && csat >= 4;
            }
            return true;
        },
        mes: (card, valor) => {
            if (!valor) return true;
            const mes = card.dataset.mes.toString().trim();
            return mes === valor.toString().trim();
        }
    };

    // Seletores dos filtros e a chave no objeto filtros
    const filtrosMap = {
        filtroNps: 'nps',
        filtroCsat: 'csat',
        filtroMes: 'mes',
    };

    // Função que aplica todos os filtros registrados
    function aplicarFiltros() {
        // Pega os valores atuais dos selects
        const valoresFiltros = {};
        for (const seletor in filtrosMap) {
            const filtroKey = filtrosMap[seletor];
            const elemento = document.getElementById(seletor);
            valoresFiltros[filtroKey] = elemento ? elemento.value : null;
        }

        cards.forEach(card => {
            // Para cada card, aplica todos os filtros, se algum for falso esconde
            let mostrar = true;
            for (const filtroKey in filtros) {
                const funcFiltro = filtros[filtroKey];
                const valorFiltro = valoresFiltros[filtroKey];
                if (!funcFiltro(card, valorFiltro)) {
                    mostrar = false;
                    break;
                }
            }
            card.style.display = mostrar ? 'block' : 'none';
        });
    }

    // Registra eventos de change para todos os selects
    for (const seletor in filtrosMap) {
        const elemento = document.getElementById(seletor);
        if (elemento) {
            elemento.addEventListener('change', aplicarFiltros);
        }
    }
});
