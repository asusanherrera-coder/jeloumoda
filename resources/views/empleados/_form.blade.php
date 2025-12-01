@csrf

<div class="form-grid">
    <div class="form-group">
        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni"
               value="{{ old('dni', $empleado->dni ?? '') }}" required>
        @error('dni') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" id="nombres" name="nombres"
               value="{{ old('nombres', $empleado->nombres ?? '') }}" required>
        @error('nombres') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono"
               value="{{ old('telefono', $empleado->telefono ?? '') }}">
        @error('telefono') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo"
               value="{{ old('correo', $empleado->correo ?? '') }}" required>
        @error('correo') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="cargo">Cargo</label>
        <input type="text" id="cargo" name="cargo"
               value="{{ old('cargo', $empleado->cargo ?? '') }}" required>
        @error('cargo') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group form-full">
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion"
               value="{{ old('direccion', $empleado->direccion ?? '') }}">
        @error('direccion') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="fecha_ingreso">Fecha de ingreso</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso"
               value="{{ old('fecha_ingreso', isset($empleado->fecha_ingreso) ? \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('Y-m-d') : '') }}"
               required>
        @error('fecha_ingreso') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
            <option value="activo"   {{ old('estado', $empleado->estado ?? '') === 'activo'   ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ old('estado', $empleado->estado ?? '') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        @error('estado') <span class="error-text">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn-primary">
        {{ $btnText }}
    </button>
    <a href="{{ route('empleados.index') }}" class="btn-cancel">Cancelar</a>
</div>
