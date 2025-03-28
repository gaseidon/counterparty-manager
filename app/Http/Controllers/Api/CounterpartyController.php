<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCounterpartyRequest;
use App\Models\Counterparty;
use App\Services\DaDataService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Counterparties",
 *     description="Управление контрагентами"
 * )
 */
class CounterpartyController extends Controller
{
    public function __construct(private DaDataService $daDataService) {}

    /**
     * @OA\Post(
     *     path="/api/counterparties",
     *     tags={"Counterparties"},
     *     summary="Создание нового контрагента по ИНН",
     *     description="Создает нового контрагента на основе ИНН, получая данные из сервиса DaData",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для создания контрагента",
     *         @OA\JsonContent(
     *             required={"inn"},
     *             @OA\Property(property="inn", type="string", example="7707083893", description="ИНН организации (10 или 12 цифр)")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Контрагент успешно создан",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="inn", type="string", example="7707083893"),
     *             @OA\Property(property="name", type="string", example="ООО Ромашка"),
     *             @OA\Property(property="ogrn", type="string", example="1027700092661"),
     *             @OA\Property(property="address", type="string", example="г Москва, ул Ленина, д 1"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизованный доступ",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Контрагент не найден в DaData",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Counterparty not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="inn",
     *                     type="array",
     *                     @OA\Items(type="string", example="The inn has already been taken")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(StoreCounterpartyRequest $request): JsonResponse
    {
        $data = $this->daDataService->getCounterpartyData($request->inn);

        if (!$data) {
            return response()->json(['message' => 'Counterparty not found'], 404);
        }

        $counterparty = Counterparty::create(array_merge(
            ['user_id' => auth()->id()],
            $data->toArray()
        ));

        return response()->json($counterparty, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/counterparties",
     *     tags={"Counterparties"},
     *     summary="Получение списка всех контрагентов текущего пользователя",
     *     description="Возвращает полный список контрагентов, принадлежащих текущему пользователю",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный запрос",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="inn", type="string", example="7707083893"),
     *                 @OA\Property(property="name", type="string", example="ООО Ромашка"),
     *                 @OA\Property(property="ogrn", type="string", example="1027700092661"),
     *                 @OA\Property(property="address", type="string", example="г Москва, ул Ленина, д 1"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизованный доступ",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(
            auth()->user()->counterparties()->get()
        );
    }
}
