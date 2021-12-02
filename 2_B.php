<?php
echo array_reduce(
	array_filter(
		array_reduce(
			array_map(
				fn($x) => [
						// - horiz
						$x[0] === 'forward' 
						? (int)$x[1] 
						: 0, 
						// - vert
						0, 
						// - aim
						(
							$x[0] === 'up' 
							? -(int)$x[1] 
							: (
								$x[0] === 'down' 
								? (int)$x[1] 
								: 0
							)
						)
					], 
					array_map(
						fn($l) => explode(' ', $l), 
						array_filter(
							explode(
								PHP_EOL, 
								file_get_contents(__DIR__.'/2.txt')
							), 
							fn($l) => $l !== ''
						)
					)
			), 
			fn($c, $x) => [
				$c[0] + $x[0], // horiz
				$c[1] + ($x[0] * $c[2]), // depth
				$c[2] + $x[2] // aim
				], 
			[0, 0, 0]
		), 
		fn($k) => $k !== 2,
		ARRAY_FILTER_USE_KEY 
	), 
	fn($c, $x) => $c*$x, 
	1
);