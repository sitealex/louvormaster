<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LouvorMaster - Gerenciamento de Repertório</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="dashboard-tab">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="repertorio-tab">
                                <i class="fas fa-music"></i> Repertório
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="escalas-tab">
                                <i class="fas fa-calendar-alt"></i> Escalas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="eventos-tab">
                                <i class="fas fa-church"></i> Eventos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="membros-tab">
                                <i class="fas fa-users"></i> Membros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="mensagens-tab">
                                <i class="fas fa-comment-alt"></i> Mensagens
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="config-tab">
                                <i class="fas fa-cog"></i> Configurações
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">LouvorMaster</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="sync-button">
                                <i class="fas fa-sync-alt"></i> Sincronizar
                            </button>
                        </div>
                        <div id="connection-status" class="badge bg-secondary">Offline</div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div id="dashboard-content" class="tab-content">
                    <!-- Dashboard Content -->
                    <div class="tab-pane fade show active" id="dashboard">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Músicas no Repertório</h5>
                                        <p class="card-text display-4" id="total-musicas">0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Próximo Evento</h5>
                                        <p class="card-text" id="proximo-evento">Nenhum evento agendado</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-info mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Membros Cadastrados</h5>
                                        <p class="card-text display-4" id="total-membros">0</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Músicas Mais Tocadas</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group" id="mais-tocadas">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Carregando...
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Aniversariantes do Mês</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group" id="aniversariantes">
                                            <li class="list-group-item">Nenhum aniversariante este mês</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Repertório Content -->
                    <div class="tab-pane fade" id="repertorio">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Repertório Musical</h2>
                            <div>
                                <button class="btn btn-primary" id="add-musica-btn">
                                    <i class="fas fa-plus"></i> Adicionar Música
                                </button>
                                <button class="btn btn-secondary" id="import-musica-btn">
                                    <i class="fas fa-file-import"></i> Importar
                                </button>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search-musica" placeholder="Buscar música...">
                                    <button class="btn btn-outline-secondary" type="button" id="search-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="youtube-search" placeholder="Buscar no YouTube...">
                                    <button class="btn btn-outline-danger" type="button" id="youtube-search-btn">
                                        <i class="fab fa-youtube"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Artista</th>
                                        <th>Tonalidade</th>
                                        <th>Vezes Tocada</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="repertorio-table">
                                    <tr>
                                        <td colspan="6">Carregando repertório...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- YouTube Results Modal -->
                        <div class="modal fade" id="youtubeModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Resultados do YouTube</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="youtube-results">
                                        <p>Digite uma busca acima e clique no botão do YouTube.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Add Music Modal -->
                        <div class="modal fade" id="addMusicaModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Adicionar Música ao Repertório</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="musica-form">
                                            <div class="mb-3">
                                                <label for="musica-titulo" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="musica-titulo" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="musica-artista" class="form-label">Artista/Banda</label>
                                                <input type="text" class="form-control" id="musica-artista">
                                            </div>
                                            <div class="mb-3">
                                                <label for="musica-tonalidade" class="form-label">Tonalidade</label>
                                                <select class="form-select" id="musica-tonalidade">
                                                    <option value="C">C</option>
                                                    <option value="C#/Db">C#/Db</option>
                                                    <option value="D">D</option>
                                                    <option value="D#/Eb">D#/Eb</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                    <option value="F#/Gb">F#/Gb</option>
                                                    <option value="G">G</option>
                                                    <option value="G#/Ab">G#/Ab</option>
                                                    <option value="A">A</option>
                                                    <option value="A#/Bb">A#/Bb</option>
                                                    <option value="B">B</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="musica-link" class="form-label">Link do YouTube</label>
                                                <input type="url" class="form-control" id="musica-link" placeholder="https://www.youtube.com/watch?v=...">
                                            </div>
                                            <div class="mb-3">
                                                <label for="musica-letra" class="form-label">Letra (opcional)</label>
                                                <textarea class="form-control" id="musica-letra" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="musica-cifra" class="form-label">Cifra (opcional)</label>
                                                <textarea class="form-control" id="musica-cifra" rows="5"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="save-musica-btn">Salvar Música</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Escalas Content -->
                    <div class="tab-pane fade" id="escalas">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Escalas de Louvor</h2>
                            <button class="btn btn-primary" id="add-escala-btn">
                                <i class="fas fa-plus"></i> Nova Escala
                            </button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Evento</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Participantes</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="escalas-table">
                                    <tr>
                                        <td colspan="6">Carregando escalas...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Add Escala Modal -->
                        <div class="modal fade" id="addEscalaModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Nova Escala de Louvor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="escala-form">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="escala-evento" class="form-label">Nome do Evento</label>
                                                    <input type="text" class="form-control" id="escala-evento" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="escala-data" class="form-label">Data</label>
                                                    <input type="date" class="form-control" id="escala-data" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="escala-hora" class="form-label">Horário</label>
                                                    <input type="time" class="form-control" id="escala-hora" required>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="escala-observacoes" class="form-label">Observações</label>
                                                <textarea class="form-control" id="escala-observacoes" rows="2"></textarea>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Cor das Roupas</label>
                                                <div class="color-palette">
                                                    <input type="radio" name="escala-cor" id="cor-padrao" value="padrao" checked>
                                                    <label for="cor-padrao" class="color-option" style="background-color: #6c757d;" title="Padrão"></label>
                                                    
                                                    <input type="radio" name="escala-cor" id="cor-branco" value="branco">
                                                    <label for="cor-branco" class="color-option" style="background-color: #ffffff; border: 1px solid #ddd;" title="Branco"></label>
                                                    
                                                    <input type="radio" name="escala-cor" id="cor-preto" value="preto">
                                                    <label for="cor-preto" class="color-option" style="background-color: #000000;" title="Preto"></label>
                                                    
                                                    <input type="radio" name="escala-cor" id="cor-azul" value="azul">
                                                    <label for="cor-azul" class="color-option" style="background-color: #0d6efd;" title="Azul"></label>
                                                    
                                                    <input type="radio" name="escala-cor" id="cor-vermelho" value="vermelho">
                                                    <label for="cor-vermelho" class="color-option" style="background-color: #dc3545;" title="Vermelho"></label>
                                                    
                                                    <input type="radio" name="escala-cor" id="cor-verde" value="verde">
                                                    <label for="cor-verde" class="color-option" style="background-color: #198754;" title="Verde"></label>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Participantes</label>
                                                <div id="membros-disponiveis" class="mb-3">
                                                    <!-- Membros serão carregados aqui -->
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Repertório</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="select-musica">
                                                        <option selected>Selecione uma música...</option>
                                                    </select>
                                                    <button class="btn btn-outline-primary" type="button" id="add-musica-escala">
                                                        <i class="fas fa-plus"></i> Adicionar
                                                    </button>
                                                </div>
                                                <ul class="list-group" id="musicas-escala">
                                                    <!-- Músicas da escala serão listadas aqui -->
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="save-escala-btn">Salvar Escala</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Eventos Content -->
                    <div class="tab-pane fade" id="eventos">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Eventos e Roteiros</h2>
                            <button class="btn btn-primary" id="add-evento-btn">
                                <i class="fas fa-plus"></i> Novo Evento
                            </button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Data</th>
                                        <th>Horário</th>
                                        <th>Local</th>
                                        <th>Responsável</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="eventos-table">
                                    <tr>
                                        <td colspan="6">Carregando eventos...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Add Evento Modal -->
                        <div class="modal fade" id="addEventoModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Novo Evento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="evento-form">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="evento-titulo" class="form-label">Título do Evento</label>
                                                    <input type="text" class="form-control" id="evento-titulo" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="evento-data" class="form-label">Data</label>
                                                    <input type="date" class="form-control" id="evento-data" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="evento-hora" class="form-label">Horário</label>
                                                    <input type="time" class="form-control" id="evento-hora" required>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="evento-local" class="form-label">Local</label>
                                                <input type="text" class="form-control" id="evento-local" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="evento-descricao" class="form-label">Descrição</label>
                                                <textarea class="form-control" id="evento-descricao" rows="3"></textarea>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="evento-responsavel" class="form-label">Responsável</label>
                                                <select class="form-select" id="evento-responsavel">
                                                    <!-- Membros serão carregados aqui -->
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Passagem de Som</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="evento-passagem-data" class="form-label">Data</label>
                                                        <input type="date" class="form-control" id="evento-passagem-data">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="evento-passagem-hora" class="form-label">Horário</label>
                                                        <input type="time" class="form-control" id="evento-passagem-hora">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Roteiro</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-select" id="select-musica-evento">
                                                        <option selected>Selecione uma música...</option>
                                                    </select>
                                                    <button class="btn btn-outline-primary" type="button" id="add-musica-evento">
                                                        <i class="fas fa-plus"></i> Adicionar
                                                    </button>
                                                </div>
                                                <ul class="list-group" id="musicas-evento">
                                                    <!-- Músicas do evento serão listadas aqui -->
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="save-evento-btn">Salvar Evento</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Membros Content -->
                    <div class="tab-pane fade" id="membros">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Membros do Grupo</h2>
                            <button class="btn btn-primary" id="add-membro-btn">
                                <i class="fas fa-plus"></i> Novo Membro
                            </button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Função</th>
                                        <th>Telefone</th>
                                        <th>Email</th>
                                        <th>Aniversário</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="membros-table">
                                    <tr>
                                        <td colspan="6">Carregando membros...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Add Membro Modal -->
                        <div class="modal fade" id="addMembroModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Adicionar Membro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="membro-form">
                                            <div class="mb-3">
                                                <label for="membro-nome" class="form-label">Nome Completo</label>
                                                <input type="text" class="form-control" id="membro-nome" required>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="membro-telefone" class="form-label">Telefone</label>
                                                    <input type="tel" class="form-control" id="membro-telefone">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="membro-email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="membro-email">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="membro-funcao" class="form-label">Função Principal</label>
                                                <select class="form-select" id="membro-funcao" required>
                                                    <option value="">Selecione...</option>
                                                    <option value="Vocalista">Vocalista</option>
                                                    <option value="Baterista">Baterista</option>
                                                    <option value="Guitarrista">Guitarrista</option>
                                                    <option value="Baixista">Baixista</option>
                                                    <option value="Tecladista">Tecladista</option>
                                                    <option value="Violonista">Violonista</option>
                                                    <option value="Ministro">Ministro</option>
                                                    <option value="Backing Vocal">Backing Vocal</option>
                                                    <option value="Outro">Outro</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3" id="outra-funcao-container" style="display: none;">
                                                <label for="membro-outra-funcao" class="form-label">Especificar Função</label>
                                                <input type="text" class="form-control" id="membro-outra-funcao">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="membro-aniversario" class="form-label">Data de Nascimento</label>
                                                <input type="date" class="form-control" id="membro-aniversario">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="membro-observacoes" class="form-label">Observações</label>
                                                <textarea class="form-control" id="membro-observacoes" rows="3"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="save-membro-btn">Salvar Membro</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mensagens Content -->
                    <div class="tab-pane fade" id="mensagens">
                        <div class="d-flex justify-content-between mb-3">
                            <h2>Mensagens WhatsApp</h2>
                            <button class="btn btn-primary" id="add-mensagem-btn">
                                <i class="fas fa-plus"></i> Nova Mensagem
                            </button>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Modelos de Mensagens</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group" id="modelos-mensagens">
                                            <li class="list-group-item">Convite para Ensaio</li>
                                            <li class="list-group-item">Confirmação de Escala</li>
                                            <li class="list-group-item">Lembrete de Evento</li>
                                            <li class="list-group-item">Mensagem Personalizada</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Enviar Mensagem</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="mensagem-form">
                                            <div class="mb-3">
                                                <label for="mensagem-modelo" class="form-label">Modelo</label>
                                                <select class="form-select" id="mensagem-modelo">
                                                    <option value="convite">Convite para Ensaio</option>
                                                    <option value="confirmacao">Confirmação de Escala</option>
                                                    <option value="lembrete">Lembrete de Evento</option>
                                                    <option value="personalizada">Personalizada</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="mensagem-destinatarios" class="form-label">Destinatários</label>
                                                <select class="form-select" id="mensagem-destinatarios" multiple>
                                                    <!-- Membros serão carregados aqui -->
                                                </select>
                                                <div class="form-text">Segure Ctrl para selecionar múltiplos membros</div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="mensagem-texto" class="form-label">Mensagem</label>
                                                <textarea class="form-control" id="mensagem-texto" rows="5" required></textarea>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="mensagem-data" class="form-label">Agendar Envio (opcional)</label>
                                                <input type="datetime-local" class="form-control" id="mensagem-data">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success" id="enviar-mensagem-btn">
                                            <i class="fab fa-whatsapp"></i> Enviar Mensagem
                                        </button>
                                        <button class="btn btn-secondary ms-2" id="testar-mensagem-btn">
                                            <i class="fas fa-eye"></i> Visualizar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Configurações Content -->
                    <div class="tab-pane fade" id="config">
                        <h2>Configurações do Sistema</h2>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Configurações Gerais</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="config-geral-form">
                                            <div class="mb-3">
                                                <label for="config-nome-grupo" class="form-label">Nome do Grupo</label>
                                                <input type="text" class="form-control" id="config-nome-grupo">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="config-igreja" class="form-label">Igreja/Organização</label>
                                                <input type="text" class="form-control" id="config-igreja">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="config-responsavel" class="form-label">Responsável</label>
                                                <input type="text" class="form-control" id="config-responsavel">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="config-email" class="form-label">Email de Contato</label>
                                                <input type="email" class="form-control" id="config-email">
                                            </div>
                                            
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="config-notificacoes">
                                                <label class="form-check-label" for="config-notificacoes">Ativar Notificações</label>
                                            </div>
                                            
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" class="form-check-input" id="config-sincronizacao-auto">
                                                <label class="form-check-label" for="config-sincronizacao-auto">Sincronização Automática</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" id="salvar-config-geral">
                                            <i class="fas fa-save"></i> Salvar Configurações
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Sincronização e Backup</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Status da Sincronização</label>
                                            <div class="alert alert-info" id="sync-status">
                                                Verificando status...
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <button class="btn btn-outline-primary w-100" id="backup-btn">
                                                <i class="fas fa-download"></i> Criar Backup
                                            </button>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="restore-file" class="form-label">Restaurar Backup</label>
                                            <input type="file" class="form-control" id="restore-file">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <button class="btn btn-outline-secondary w-100" id="restore-btn" disabled>
                                                <i class="fas fa-upload"></i> Restaurar
                                            </button>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <button class="btn btn-outline-danger w-100" id="limpar-dados-btn">
                                                <i class="fas fa-trash"></i> Limpar Todos os Dados Locais
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/db.js"></script>
    <script src="js/app.js"></script>
    <script src="js/sync.js"></script>
</body>
</html>