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
        $pdf->SetFont('Arial','B',16);

        // Título
        $pdf->Cell(0,10, utf8_decode('Boleta de compra - Jelou Moda'), 0, 1, 'C');
        $pdf->Ln(5);

        // Datos básicos
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(0,6, utf8_decode('ID Compra: '.$compra->id_compra), 0, 1);
        $pdf->Cell(0,6, utf8_decode('Transacción: '.$compra->transaction_id), 0, 1);
        $pdf->Cell(0,6, utf8_decode('Método de pago: '.ucfirst($compra->metodo_pago)), 0, 1);
        $pdf->Cell(0,6, utf8_decode('Monto total: S/ '.number_format($compra->monto_total,2)), 0, 1);
        $pdf->Cell(0,6, utf8_decode('Estado: '.ucfirst($compra->estado_pago)), 0, 1);
        $pdf->Cell(0,6, utf8_decode('Fecha: '.$compra->fecha_compra), 0, 1);

        if ($compra->cliente) {
            $pdf->Ln(4);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,7, utf8_decode('Datos del cliente'), 0, 1);
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(0,6, utf8_decode('Nombre: '.$compra->cliente->nombre), 0, 1);
        }


        $pdf->Ln(6);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,7, utf8_decode('Detalle del carrito'), 0, 1);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(80,7, utf8_decode('Producto'), 1, 0);
        $pdf->Cell(30,7, utf8_decode('Cant.'), 1, 0, 'C');
        $pdf->Cell(40,7, utf8_decode('Precio (S/)'), 1, 0, 'R');
        $pdf->Cell(40,7, utf8_decode('Subtotal (S/)'), 1, 1, 'R');

        $pdf->SetFont('Arial','',9);

        $items = json_decode($compra->datos_carrito, true) ?: [];

        foreach ($items as $item) {
            $nombre   = isset($item['nombre'])   ? $item['nombre']   : 'Producto';
            $cantidad = isset($item['cantidad']) ? $item['cantidad'] : 1;
            $precio   = isset($item['precio'])   ? $item['precio']   : 0;
            $subtotal = $precio * $cantidad;

            $pdf->Cell(80,6, utf8_decode($nombre), 1, 0);
            $pdf->Cell(30,6, $cantidad, 1, 0, 'C');
            $pdf->Cell(40,6, number_format($precio,2), 1, 0, 'R');
            $pdf->Cell(40,6, number_format($subtotal,2), 1, 1, 'R');
        }


        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(150,7, utf8_decode('Total pagado'), 1, 0, 'R');
        $pdf->Cell(40,7, 'S/ '.number_format($compra->monto_total,2), 1, 1, 'R');

        $nombreArchivo = 'boleta_'.$compra->transaction_id.'.pdf';

   
        return response($pdf->Output('S', $nombreArchivo))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="'.$nombreArchivo.'"');
    }
}
