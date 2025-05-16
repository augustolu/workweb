<?php

namespace App\Controllers;

use App\Models\Tarea;
use App\Models\MiembroSubtarea;
use App\Models\Colaboracion;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function inicio()
    {
        $session = session();
        $usuarioId = $session->get('id_usuario');

        if (!$usuarioId) {
            return redirect()->to('/login');
        }

        $modeloColaboracion = new Colaboracion();
        $modeloMiembroSub = new MiembroSubtarea();
        $modeloTarea = new Tarea();

        $tareasResponsable = [];
        $subTareasResponsable = [];
        $usuariosResponsablesSub = [];

        $usuariosResponsables = $modeloColaboracion->obtenerColaboradores($usuarioId);
        $TodosUsuariosSubTarea = $modeloMiembroSub->obtenerMiembrosSubTarea();

        foreach ($TodosUsuariosSubTarea as $usSubTarea) {
            if ($usSubTarea['usuario_id'] == $usuarioId) {
                $subUsuarios = $modeloMiembroSub->obtenerUsuariosConDatosPorSubtarea($usSubTarea['subtarea_id']);
                foreach ($subUsuarios as $usResponsable) {
                    $usuariosResponsablesSub[] = $usResponsable;
                    if ($usResponsable['usuario_id'] == $usuarioId) {
                        $subTareasResponsable[] = $usResponsable['subtarea_id'];
                    }
                }
            }
        }

        foreach ($usuariosResponsables as $usResponsable) {
            if ($usResponsable['usuario_id'] == $usuarioId) {
                $tareasResponsable[] = $usResponsable['tarea_id'];
            }
        }

        $tareasPropias = $modeloTarea->obtenerTareasNoArchivadas($usuarioId);
        $tareasColaborativas = $modeloTarea->obtenerTareasColaborativas($usuarioId);

        $hoy = Time::now()->toDateString();
        $recordatorios = [];
        $todasLasTareas = array_merge($tareasPropias, $tareasColaborativas);

        foreach ($todasLasTareas as $tarea) {
            if (!empty($tarea['fecha_recordatorio'])) {
                $fechaRecordatorio = Time::parse($tarea['fecha_recordatorio'])->toDateString();
                if ($fechaRecordatorio == $hoy) {
                    $recordatorios[] = "📌 Tenés un recordatorio pendiente para la tarea: <strong>{$tarea['titulo']}</strong>";
                }
            }
        }

        $data = [
            'RecordatorioAlerta' => $recordatorios,
            'tareas_propias' => $tareasPropias,
            'tareas_colaborativas' => $tareasColaborativas
        ];

        return view('inicioView', $data);
    }
}
