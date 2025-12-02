<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class CompraAdminController extends Controller
{
    public function index()
    {
        $compras = Compra::with('cliente')
            ->orderByDesc('id_compra')
            ->paginate(10);

        return view('compras.index', compact('compras'));
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();

        return redirect()->route('compras.index')
            ->with('status', 'Compra eliminada correctamente.');
    }

    public function pdf(Compra $compra)
    {
        $pdf = new Fpdf();
        $pdf->AddPage();
        
        // --- 1. ENCABEZADO SUPERIOR ---
        
        // A) LOGO (Izquierda)
        try {
            // Ajusta el nombre del archivo si es Logo.png o logo.png
            $logoPath = public_path('IMG/Logo.png'); 
            // Parámetros: ruta, x, y, ancho (mm)
            $pdf->Image($logoPath, 10, 10, 30); 
        } catch (\Exception $e) {
            // Si falla la imagen, no rompemos el PDF
        }

        // B) DATOS DE LA EMPRESA (Centro-Izquierda, debajo o al lado del logo)
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetXY(45, 10); 
        $pdf->Cell(0, 10, 'JELOU MODA', 0, 1);
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(45);
        $pdf->Cell(0, 5, utf8_decode('Venta de ropa y accesorios exclusivos'), 0, 1);
        $pdf->SetX(45);
        $pdf->Cell(0, 5, utf8_decode('Dirección: Av. La Moda 123, Lima, Perú'), 0, 1); // ¡Edita esto!
        $pdf->SetX(45);
        $pdf->Cell(0, 5, utf8_decode('Tel: 936 033 151 | Email: contacto@jeloumoda.com'), 0, 1);

        // C) CUADRO DE RUC / BOLETA (Derecha)
        // Dibujamos un rectangulo
        $pdf->SetFillColor(255, 255, 255); // Fondo blanco
        $pdf->Rect(140, 10, 60, 25); // x, y, ancho, alto
        
        $pdf->SetXY(140, 12);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(60, 5, utf8_decode('R.U.C. 10123456789'), 0, 1, 'C'); // ¡Pon tu RUC real!
        
        $pdf->SetXY(140, 19);
        $pdf->SetFillColor(0, 0, 0); // Fondo negro para título
        $pdf->SetTextColor(255, 255, 255); // Texto blanco
        $pdf->Cell(60, 7, utf8_decode('BOLETA DE VENTA'), 0, 1, 'C', true);
        
        $pdf->SetTextColor(0, 0, 0); // Volvemos a texto negro
        $pdf->SetXY(140, 28);
        $pdf->SetFont('Arial', '', 10);
        // Usamos el ID de compra formateado como número de boleta
        $nroBoleta = str_pad($compra->id_compra, 8, '0', STR_PAD_LEFT);
        $pdf->Cell(60, 5, utf8_decode('Nº 001 - ' . $nroBoleta), 0, 1, 'C');

        // Línea separadora
        $pdf->Ln(15);
        $pdf->Line(10, 45, 200, 45); 
        $pdf->Ln(5);

        // --- 2. DATOS DEL CLIENTE Y COMPRA ---

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(100, 6, utf8_decode('DATOS DEL CLIENTE:'), 0, 0);
        $pdf->Cell(90, 6, utf8_decode('DETALLES DE LA COMPRA:'), 0, 1);

        $pdf->SetFont('Arial', '', 9);
        
        // Cliente
        $nombreCliente = $compra->cliente ? $compra->cliente->nombre : 'Cliente General';
        $emailCliente = $compra->cliente ? $compra->cliente->correo : '-';
        $telefonoCliente = $compra->cliente ? $compra->cliente->telefono : '-';
        $dirCliente = $compra->cliente ? $compra->cliente->direccion : '-';

        // Usamos MultiCell o celdas fijas
        $yInicio = $pdf->GetY();
        
        // Columna Izquierda (Cliente)
        $pdf->Cell(25, 5, 'Cliente:', 0, 0);
        $pdf->Cell(70, 5, utf8_decode($nombreCliente), 0, 1);
        $pdf->Cell(25, 5, utf8_decode('Teléfono:'), 0, 0);
        $pdf->Cell(70, 5, utf8_decode($telefonoCliente), 0, 1);
        $pdf->Cell(25, 5, utf8_decode('Dirección:'), 0, 0);
        // MultiCell para dirección larga
        $xActual = $pdf->GetX();
        $yActual = $pdf->GetY();
        $pdf->MultiCell(70, 5, utf8_decode($dirCliente), 0, 'L');
        
        // Columna Derecha (Compra) - Volvemos arriba
        $pdf->SetXY(110, $yInicio);
        $pdf->Cell(35, 5, utf8_decode('Fecha Emisión:'), 0, 0);
        $pdf->Cell(50, 5, $compra->fecha_compra, 0, 1);
        
        $pdf->SetX(110);
        $pdf->Cell(35, 5, utf8_decode('Método Pago:'), 0, 0);
        $pdf->Cell(50, 5, ucfirst($compra->metodo_pago), 0, 1);
        
        $pdf->SetX(110);
        $pdf->Cell(35, 5, utf8_decode('Transacción ID:'), 0, 0);
        $pdf->SetFont('Arial', '', 8); // Letra más chica para el ID largo
        $pdf->Cell(50, 5, $compra->transaction_id, 0, 1);
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->SetX(110);
        $pdf->Cell(35, 5, utf8_decode('Estado:'), 0, 0);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(50, 5, ucfirst($compra->estado_pago), 0, 1);

        $pdf->Ln(15);

        // --- 3. TABLA DE PRODUCTOS ---

        $pdf->SetFont('Arial', 'B', 9);
        // Color de fondo para encabezado de tabla (Gris claro)
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Cell(10, 8, '#', 1, 0, 'C', true);
        $pdf->Cell(90, 8, utf8_decode('Descripción'), 1, 0, 'L', true);
        $pdf->Cell(20, 8, 'Cant.', 1, 0, 'C', true);
        $pdf->Cell(35, 8, 'Precio Unit.', 1, 0, 'R', true);
        $pdf->Cell(35, 8, 'Subtotal', 1, 1, 'R', true);

        $pdf->SetFont('Arial', '', 9);

        $items = [];
        // Intentamos decodificar el JSON de diferentes formas por seguridad
        if (is_string($compra->datos_carrito)) {
            $items = json_decode($compra->datos_carrito, true) ?: [];
        } elseif (is_array($compra->datos_carrito)) {
            $items = $compra->datos_carrito;
        }

        $contador = 1;
        foreach ($items as $item) {
            $nombre   = isset($item['nombre'])   ? $item['nombre']   : 'Producto';
            $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 1;
            $precio   = isset($item['precio'])   ? $item['precio']   : 0;
            $subtotal = $precio * $cantidad;

            // Fila de la tabla
            $pdf->Cell(10, 7, $contador, 1, 0, 'C');
            $pdf->Cell(90, 7, utf8_decode(substr($nombre, 0, 50)), 1, 0, 'L'); // Cortamos nombre si es muy largo
            $pdf->Cell(20, 7, $cantidad, 1, 0, 'C');
            $pdf->Cell(35, 7, 'S/ '.number_format($precio, 2), 1, 0, 'R');
            $pdf->Cell(35, 7, 'S/ '.number_format($subtotal, 2), 1, 1, 'R');
            
            $contador++;
        }

        // --- 4. TOTALES ---

        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetX(115); // Movemos a la derecha
        $pdf->Cell(40, 8, 'TOTAL A PAGAR:', 0, 0, 'R');
        
        $pdf->SetFillColor(255, 240, 245); // Un rosado muy suave de fondo (opcional)
        $pdf->Cell(35, 8, 'S/ '.number_format($compra->monto_total, 2), 1, 1, 'R', true);

        // --- 5. COMPROBANTE DE IMAGEN (Si es Yape/Plin y existe) ---
        if ($compra->imagen_comprobante) {
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 10, utf8_decode('Evidencia de Pago (Adjunto):'), 0, 1, 'L');
            
            try {
                $rutaImagen = public_path('IMG/comprobantes/' . $compra->imagen_comprobante);
                if (file_exists($rutaImagen)) {
                    // Insertamos la imagen (ajusta el tamaño, ej: 80mm ancho)
                    $pdf->Image($rutaImagen, $pdf->GetX(), $pdf->GetY(), 80);
                } else {
                    $pdf->SetFont('Arial', 'I', 9);
                    $pdf->Cell(0, 10, utf8_decode('(La imagen del comprobante no se encuentra en el servidor)'), 0, 1);
                }
            } catch (\Exception $e) {
                // Error al cargar imagen
            }
        }

        $nombreArchivo = 'boleta_'.$compra->transaction_id.'.pdf';

        return response($pdf->Output('S', $nombreArchivo))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$nombreArchivo.'"');
    }
}